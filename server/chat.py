# Chat for actual functionality of bot

import json
import numpy as np
import pickle
from tensorflow import keras
from openai import OpenAI

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

# Initialize OpenAI GPT-3
client = OpenAI(api_key='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')

def get_response(user_message, history):
    # Find the corresponding intent in the intents file
    for i in data['intents']:
        if i['tag'] == user_message:  # Use user_message as intent
            # If there are responses in the intents file, return a random one
            if i['responses']:
                return random.choice(i['responses'])
    
    # If no response was found in the intents file or more information is needed, generate a response using OpenAI GPT-3
    prompt = f"{user_message} {history}"
    response = client.chat.completions.create(
        model="gpt-3.5-turbo",
        messages=[
            {"role": "system", "content": "You are a helpful assistant."},
            {"role": "user", "content": prompt}
        ]
    )
    return response['choices'][0]['message']['content']  # Return the generated response
