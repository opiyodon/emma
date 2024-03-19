import os
import json
import random
import pickle
import numpy as np
from tensorflow import keras
from openai import ChatCompletion
from dotenv import load_dotenv
from tensorflow.keras.preprocessing.sequence import pad_sequences

# Load intents.json file
with open('intents.json', encoding='utf-8') as file:
    data = json.load(file)

# Load trained model
model = keras.models.load_model('chat-model.keras')

# Load tokenizer object
with open('tokenizer.pickle', 'rb') as handle:
    tokenizer = pickle.load(handle)

# Load label encoder object
with open('label_encoder.pickle', 'rb') as enc:
    lbl_encoder = pickle.load(enc)

# Load environment variables from .env file
load_dotenv()

# Initialize OpenAI GPT-3.5 Turbo
client = ChatCompletion(api_key=os.getenv('OPENAI_API_KEY'))

def get_response(user_message, history):
    # Preprocess user_message
    padded_sequence = pad_sequences(tokenizer.texts_to_sequences([user_message]))
    
    # Predict intent of user_message using trained model
    prediction = model.predict(np.array(padded_sequence))
    tag = lbl_encoder.inverse_transform([np.argmax(prediction)])

    # Find the corresponding intent in the intents file
    for i in data['intents']:
        if i['tag'] == tag:
            # If there are responses in the intents file, return a random one
            if i['responses']:
                return random.choice(i['responses'])
    
    # If no response was found in the intents file or more information is needed, generate a response using OpenAI GPT-3.5 Turbo
    prompt = f"{user_message} {history}"
    response = client.create(
        model="gpt-3.5-turbo",
        messages=[
            {"role": "system", "content": "You are a helpful assistant."},
            {"role": "user", "content": prompt}
        ]
    )
    # Access the message attribute of the Choice object
    return response.choices[0].message['content']  # Return the generated response
