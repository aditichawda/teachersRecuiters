# GitHub Push Guide - Step by Step

## Problem: Dialog box आ रहा है और push नहीं हो रहा

यह issue Windows file association की वजह से हो रहा है। नीचे दिए गए steps follow करें:

## Step 1: Git Configuration (अगर पहले से नहीं है)

```powershell
cd c:\xampp\htdocs\demo.teachersrecruiter.in

# Git user name और email set करें
git config --global user.name "Your Name"
git config --global user.email "your.email@example.com"
```

## Step 2: Git Repository Initialize करें

```powershell
cd c:\xampp\htdocs\demo.teachersrecruiter.in

# अगर .git folder नहीं है तो initialize करें
git init

# सभी files add करें
git add .

# First commit करें
git commit -m "Initial commit: Post job button redirect and form UI improvements"
```

## Step 3: GitHub पर New Repository बनाएं

1. GitHub.com पर जाएं
2. New repository बनाएं (कोई भी नाम, जैसे: `teachersrecruiter-demo`)
3. **Important:** Repository को **empty** रखें (README, .gitignore, license नहीं add करें)
4. Repository URL copy करें (जैसे: `https://github.com/yourusername/teachersrecruiter-demo.git`)

## Step 4: Remote Repository Add करें और Push करें

```powershell
cd c:\xampp\htdocs\demo.teachersrecruiter.in

# Remote repository add करें (YOUR_REPO_URL को अपने repository URL से replace करें)
git remote add origin https://github.com/yourusername/your-repo-name.git

# Branch का नाम set करें (अगर main नहीं है)
git branch -M main

# Code push करें
git push -u origin main
```

## Step 5: Authentication

अगर push करते समय username/password मांगे:
- **Username:** आपका GitHub username
- **Password:** GitHub Personal Access Token (PAT) use करें, password नहीं

### Personal Access Token बनाने के लिए:
1. GitHub → Settings → Developer settings → Personal access tokens → Tokens (classic)
2. "Generate new token" click करें
3. Note में "Demo Project" लिखें
4. Expiration select करें
5. Scopes में `repo` checkbox select करें
6. "Generate token" click करें
7. Token copy करें (यह सिर्फ एक बार दिखेगा)
8. Push करते समय password की जगह यह token use करें

## Alternative: GitHub Desktop Use करें

अगर command line में problem आ रही है, तो **GitHub Desktop** use करें:

1. GitHub Desktop download करें: https://desktop.github.com/
2. Install करें और GitHub account से login करें
3. File → Add Local Repository → अपना folder select करें
4. Changes tab में सभी changes दिखेंगी
5. Summary में commit message लिखें
6. "Commit to main" click करें
7. "Publish repository" या "Push origin" click करें

## Quick Fix Script

नीचे दिया गया script run करें (YOUR_REPO_URL को replace करें):

```powershell
cd c:\xampp\htdocs\demo.teachersrecruiter.in

# Git config (अपना name और email डालें)
git config user.name "Your Name"
git config user.email "your.email@example.com"

# Initialize और add
git init
git add .

# Commit
git commit -m "Post job button redirect and form UI improvements"

# Remote add (YOUR_REPO_URL replace करें)
git remote add origin https://github.com/yourusername/your-repo-name.git

# Branch set
git branch -M main

# Push
git push -u origin main
```

## Common Issues और Solutions

### Issue 1: "fatal: not a git repository"
**Solution:** `git init` run करें

### Issue 2: "remote origin already exists"
**Solution:** 
```powershell
git remote remove origin
git remote add origin YOUR_NEW_REPO_URL
```

### Issue 3: Authentication failed
**Solution:** Personal Access Token use करें, password नहीं

### Issue 4: Dialog box आ रहा है
**Solution:** 
- Command line (PowerShell/CMD) directly use करें
- या GitHub Desktop use करें

## Files Changed (जो push होने वाले हैं):

1. `platform/themes/jobzilla/partials/navbar.blade.php` - Post job button redirect
2. `platform/plugins/job-board/src/Http/Controllers/Auth/RegisterController.php` - Account type handling
3. `platform/themes/jobzilla/views/job-board/auth/register.blade.php` - Form UI improvements

---

**Note:** अगर फिर भी problem आए तो GitHub Desktop use करें, यह सबसे आसान तरीका है।
