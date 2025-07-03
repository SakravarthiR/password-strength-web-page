# 🔐 Password Strength Checker Web App

A secure, web-based password strength checker built using:

- ✅ HTML + CSS (for frontend UI)
- ✅ PHP (for backend processing)
- ✅ C (compiled to `passphp.exe` or `passphp` for scoring logic)

This app evaluates a password based on:
- Length
- Use of uppercase and lowercase letters
- Digits
- Special characters
- Repetition
And gives a final score out of 11.

---

## 🚀 Features

- ✳️ Live password strength checker
- ✳️ Pop-up modal shows strength result
- ✳️ Prevents command injection (input is sanitized)
- ✳️ C backend offers fast, native logic execution

---

## 🧠 Password Rules (to get full score)

| Requirement                              | Score |
|------------------------------------------|-------|
| At least 8 characters                    | +1    |
| At least 3 lowercase letters             | +2    |
| At least 1 uppercase letter              | +2    |
| At least 2 digits                        | +2    |
| At least 1 special character (`!@#$...`) | +2    |
| No repeated characters                   | +2    |

**Total max score = 11**

---

## 📁 Project Structure


---

## 💻 How It Works

1. User enters a password in the web form (`index.php`)
2. JavaScript sends it to `add.php` via AJAX POST
3. `add.php`:
   - Validates input with regex
   - Ensures it matches strength rules (uppercase, digits, etc.)
   - Runs: `passphp.exe "<password>"` (Windows) or `./passphp "<password>"` (Linux)
4. The C program returns a score
5. The score is displayed on the webpage in a modal popup

---

## 🔐 Security: Input Validation in PHP

✅ Input is **strictly sanitized** in `add.php` using:

- `preg_match('/^[a-zA-Z0-9!@#$%^&*()_+=]{8,50}$/', $password)`
- `escapeshellarg()` for secure shell execution
- Extra rules:
  - Must contain at least 1 uppercase, 1 lowercase, 1 digit, 1 special character

🛡️ This **prevents command injection** or use of dangerous characters like `/`, `|`, `&&`, etc.

---

## 🛠️ How to Run Locally (Using XAMPP)

1. Install [XAMPP](https://www.apachefriends.org/)
2. Clone this repo into your `htdocs` folder:
   ```bash
   git clone https://github.com/your-username/password-strength-checker.git
