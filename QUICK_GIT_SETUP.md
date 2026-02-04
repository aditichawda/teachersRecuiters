# Quick Git Setup - Step by Step

## Problem: Popup आ रहा है और terminal wrong directory में है

## Solution: VS Code Terminal में सही Directory में जाएं

### Step 1: VS Code Terminal में ये command run करें:

```bash
cd c:\xampp\htdocs\demo.teachersrecruiter.in
```

### Step 2: Git Email Set करें (अगर नहीं है):

```bash
git config user.email "your.email@example.com"
```

### Step 3: Git Initialize करें:

```bash
git init
```

### Step 4: Files Add करें:

```bash
git add .
```

### Step 5: Commit करें:

```bash
git commit -m "Post job button redirect and form UI improvements"
```

### Step 6: GitHub Repository URL Add करें:

**पहले GitHub पर repository बनाएं:**
1. https://github.com/new पर जाएं
2. Repository name डालें
3. Empty repository बनाएं (README नहीं)
4. URL copy करें

**फिर command run करें:**
```bash
git remote add origin https://github.com/yourusername/your-repo-name.git
```

### Step 7: Push करें:

```bash
git branch -M main
git push -u origin main
```

---

## Alternative: Batch File Use करें (सबसे आसान)

1. `git-setup.bat` file को double-click करें
2. या VS Code terminal में run करें:
   ```bash
   .\git-setup.bat
   ```

---

## VS Code Terminal में Popup Issue Fix:

1. **VS Code Terminal में:**
   - Terminal tab पर right-click करें
   - "Kill Terminal" select करें
   - New terminal open करें (Ctrl + `)
   - फिर `cd c:\xampp\htdocs\demo.teachersrecruiter.in` run करें

2. **या PowerShell directly open करें:**
   - Windows key + R
   - `powershell` type करें
   - Enter दबाएं
   - फिर `cd c:\xampp\htdocs\demo.teachersrecruiter.in` run करें

---

## Important Notes:

- **Popup आने पर:** Cancel करें और command line directly use करें
- **Authentication:** GitHub username और Personal Access Token use करें (password नहीं)
- **Directory:** हमेशा `c:\xampp\htdocs\demo.teachersrecruiter.in` में commands run करें
