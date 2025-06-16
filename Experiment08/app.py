from flask import Flask, request, render_template, make_response, session, redirect, url_for
import json
from datetime import datetime

app = Flask(__name__)
app.secret_key = 'your_secret_key_here'  # Required for session

@app.route('/')
def index():
    # Check cookie for language preference
    user_language = request.cookies.get('user_language', 'not set')
    
    # Check cookie for transaction history
    transaction_history = []
    cookie_history = request.cookies.get('transaction_history')
    if cookie_history:
        transaction_history = json.loads(cookie_history)
    
    # Check session for transaction history
    session_history = session.get('transaction_history', [])
    
    return render_template('index.html',
                         user_language=user_language,
                         cookie_history=transaction_history,
                         session_history=session_history)

@app.route('/set_language/<language>')
def set_language(language):
    # Record transaction
    transaction = {
        'type': 'language_change',
        'value': language,
        'timestamp': datetime.now().isoformat()
    }
    
    # Cookie-based tracking
    cookie_history = []
    existing_cookie = request.cookies.get('transaction_history')
    if existing_cookie:
        cookie_history = json.loads(existing_cookie)
    cookie_history.append(transaction)
    
    # Session-based tracking
    if 'transaction_history' not in session:
        session['transaction_history'] = []
    session['transaction_history'].append(transaction)
    session.modified = True
    
    # Set response with cookie
    response = make_response(render_template('set_language.html', language=language))
    response.set_cookie('user_language', language)
    response.set_cookie('transaction_history', json.dumps(cookie_history), max_age=30*24*60*60)  # 30 days
    
    return response

@app.route('/cookie_history')
def show_cookie_history():
    cookie_history = []
    existing_cookie = request.cookies.get('transaction_history')
    if existing_cookie:
        cookie_history = json.loads(existing_cookie)
    return render_template('cookie_history.html', history=cookie_history)

@app.route('/session_history')
def show_session_history():
    session_history = session.get('transaction_history', [])
    return render_template('session_history.html', history=session_history)

@app.route('/clear_history')
def clear_history():
    # Clear cookie history
    response = make_response(redirect(url_for('index')))
    response.set_cookie('transaction_history', '', expires=0)
    
    # Clear session history
    if 'transaction_history' in session:
        session.pop('transaction_history')
    
    return response

if __name__ == '__main__':
    app.run(debug=True)