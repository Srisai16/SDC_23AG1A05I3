# Transaction History Tracker - Session Tracking Demonstration

## Overview

This Flask application demonstrates two session tracking mechanisms (Cookies and HTTP Sessions) for maintaining a user's transactional history. The application tracks language preference changes and maintains a history of these transactions using both cookies and server-side sessions.

## Features

- **Cookie-based Tracking**:
  - Persistent storage of language preference
  - Transaction history stored in browser cookies
  - History persists across browser sessions

- **Session-based Tracking**:
  - Server-side storage of transaction history
  - Automatically associated with user via session ID
  - Temporary storage (cleared when session ends)

- **Transaction Management**:
  - Records each language change with timestamp
  - Separate views for cookie and session histories
  - Option to clear all history

## File Structure

```
transaction_tracker/
├── app.py                # Main Flask application
├── templates/
│   ├── index.html        # Homepage with language options
│   ├── cookie_history.html # Displays cookie-based transaction history
│   ├── session_history.html # Displays session-based transaction history
│   └── set_language.html   # Confirmation page after language change
└── README.md             # This documentation file
```

## Installation

1. Ensure you have Python 3.x installed
2. Install the required packages:

```bash
pip install flask
```

## Running the Application

```bash
python app.py
```

Then open your browser and navigate to `http://localhost:5000`

## Usage

1. **Homepage**:
   - View current language preference
   - Set new language preference (English, Spanish, or French)
   - View recent transactions from both tracking methods
   - Access full history views
   - Clear all history

2. **Cookie-based History**:
   - View all transactions stored in cookies
   - Persistent across browser sessions

3. **Session-based History**:
   - View all transactions stored in server session
   - Temporary (cleared when browser closes)

## Sample Output

### Homepage (Initial Visit)
![Initial Homepage](Experiment8\Transaction-Tracker.png)

### After Setting Language to Spanish
![Language Set](Experiment8\Transaction-Tracker.png)

### Cookie Transaction History
![Cookie History](Experiment8\Transaction-Tracker.png)

### Session Transaction History
![Session History](Experiment8\Transaction-Tracker.png)

## Key Differences Demonstrated

| Feature              | Cookie-based Tracking | Session-based Tracking |
|----------------------|-----------------------|------------------------|
| Storage Location     | Client-side (browser) | Server-side            |
| Persistence          | Persistent (30 days)  | Temporary (session)    |
| Data Access          | Visible to client     | Hidden from client     |
| Capacity             | Limited (4KB)         | Larger capacity        |
| Security             | Less secure           | More secure            |

## Technical Notes

- The application uses JSON to serialize transaction data for cookie storage
- Session data is stored server-side with a secure session ID cookie
- All transactions include timestamp, action type, and value
- The cookie expiration is set to 30 days for demonstration purposes

## Clearing History

Use the "Clear All History" link to:
1. Remove the transaction history cookie
2. Clear the session transaction history

## License

This project is open-source and available under the MIT License.