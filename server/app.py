from flask import Flask, request, jsonify
from flask_cors import CORS
from chat import get_response

app = Flask(__name__)
CORS(app)

@app.route('/get-response', methods=['POST'])
def get_bot_response():
    user_message = request.json['message']
    history = request.json.get('history', '')
    bot_response = get_response(user_message, history)
    response = jsonify({'response': bot_response})
    response.headers.add('Content-Type', 'application/json;charset=utf-8')
    return response

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=8000, debug=True)
