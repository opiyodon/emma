import json
import numpy as np
import pickle
from tensorflow import keras
from tensorflow.keras.preprocessing.sequence import pad_sequences

# Load intents.json file
with open('intents.json', encoding='utf-8') as file:  # Specify encoding to avoid UnicodeDecodeError
    data = json.load(file)

# Load trained model
model = keras.models.load_model('chat-model.keras')

# Load tokenizer object
with open('tokenizer.pickle', 'rb') as handle:
    tokenizer = pickle.load(handle)

# Load label encoder object
with open('label_encoder.pickle', 'rb') as enc:
    lbl_encoder = pickle.load(enc)

def get_response(user_message):
    result = model.predict(keras.preprocessing.sequence.pad_sequences(tokenizer.texts_to_sequences([user_message]), truncating='post'))
    tag = lbl_encoder.inverse_transform([np.argmax(result)])

    for i in data['intents']:
        if i['tag'] == tag:
            return np.random.choice(i['responses'])
        
        

