@echo off
echo ========================================
echo GitHub Push Setup Script
echo ========================================
echo.

cd /d c:\xampp\htdocs\demo.teachersrecruiter.in
echo Current directory: %CD%
echo.

echo Step 1: Checking Git configuration...
git config user.name
git config user.email
echo.

echo Step 2: Initializing Git (if needed)...
if not exist .git (
    git init
    echo Git initialized!
) else (
    echo Git already initialized.
)
echo.

echo Step 3: Adding files...
git add .
echo Files added.
echo.

echo Step 4: Checking status...
git status --short
echo.

echo Step 5: Committing changes...
git commit -m "Post job button redirect and form UI improvements"
echo.

echo Step 6: Remote repository setup...
echo Please provide your GitHub repository URL:
echo Example: https://github.com/yourusername/your-repo-name.git
echo.
set /p REPO_URL="Enter repository URL: "

if "%REPO_URL%"=="" (
    echo No URL provided. Exiting...
    pause
    exit
)

git remote remove origin 2>nul
git remote add origin %REPO_URL%
echo Remote repository added: %REPO_URL%
echo.

echo Step 7: Setting branch to main...
git branch -M main
echo.

echo Step 8: Pushing to GitHub...
echo Note: You will be asked for GitHub credentials
echo Use your GitHub username and Personal Access Token
echo.
git push -u origin main

echo.
echo ========================================
echo Setup complete!
echo ========================================
pause
