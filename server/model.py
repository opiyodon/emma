# Model for training bot

import json
import pickle
import numpy as np
from sklearn.model_selection import train_test_split
from tensorflow.keras.models import Sequential
from tensorflow.keras.layers import Dense, Embedding, GlobalAveragePooling1D, Dropout
from tensorflow.keras.preprocessing.text import Tokenizer
from tensorflow.keras.preprocessing.sequence import pad_sequences
from sklearn.preprocessing import LabelEncoder
from tensorflow.keras.callbacks import EarlyStopping, ModelCheckpoint

# Load intents.json file
with open('intents.json', encoding='utf-8') as file:
    data = json.load(file)

# Extract data from intents.json
training_sentences = []
training_labels = []
labels = []
responses = []

for intent in data['intents']:
    for pattern in intent['patterns']:
        training_sentences.append(pattern)
        training_labels.append(intent['tag'])
    responses.append(intent['responses'])

    if intent['tag'] not in labels:
        labels.append(intent['tag'])

num_classes = len(labels)

# Encode labels
lbl_encoder = LabelEncoder()
lbl_encoder.fit(training_labels)
training_labels = lbl_encoder.transform(training_labels)

# Text preprocessing
vocab_size = 10000
embedding_dim = 128
oov_token = "<OOV>"

tokenizer = Tokenizer(num_words=vocab_size, oov_token=oov_token)
tokenizer.fit_on_texts(training_sentences)
word_index = tokenizer.word_index
sequences = tokenizer.texts_to_sequences(training_sentences)
padded_sequences = pad_sequences(sequences, truncating='post')

# Splitting data into training and validation sets
train_sequences, val_sequences, train_labels, val_labels = train_test_split(padded_sequences, training_labels, test_size=0.2)

# Model
model = Sequential()
model.add(Embedding(vocab_size, embedding_dim))
model.add(GlobalAveragePooling1D())
model.add(Dense(128, activation='relu'))
model.add(Dropout(0.5))
model.add(Dense(128, activation='relu'))
model.add(Dropout(0.5))
model.add(Dense(num_classes, activation='softmax'))

model.compile(loss='sparse_categorical_crossentropy', optimizer='adam', metrics=['accuracy'])

# Train the model
epochs = 5000
early_stop = EarlyStopping(monitor='val_loss', patience=10)
model_checkpoint = ModelCheckpoint('chat-model.keras', save_best_only=True, monitor='val_loss', mode='min')
model.fit(train_sequences, np.array(train_labels), validation_data=(val_sequences, np.array(val_labels)), epochs=epochs, callbacks=[early_stop, model_checkpoint])

# Save the fitted tokenizer
with open('tokenizer.pickle', 'wb') as handle:
    pickle.dump(tokenizer, handle, protocol=pickle.HIGHEST_PROTOCOL)

# Save the fitted label encoder
with open('label_encoder.pickle', 'wb') as enc:
    pickle.dump(lbl_encoder, enc, protocol=pickle.HIGHEST_PROTOCOL)
