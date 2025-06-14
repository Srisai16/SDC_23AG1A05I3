// Get elements
const addTransactionButton = document.getElementById('addTransaction');
const descriptionInput = document.getElementById('description');
const amountInput = document.getElementById('amount');
const typeSelect = document.getElementById('type');
const budgetInput = document.getElementById('budget');
const transactionList = document.getElementById('transaction-list');
const incomeAmount = document.getElementById('income-amount');
const expenseAmount = document.getElementById('expense-amount');
const remainingBudget = document.getElementById('remaining-budget');

// Get data from LocalStorage or initialize empty arrays
let transactions = JSON.parse(localStorage.getItem('transactions')) || [];

// Event listener for adding a transaction
addTransactionButton.addEventListener('click', () => {
  const description = descriptionInput.value;
  const amount = parseFloat(amountInput.value);
  const type = typeSelect.value;

  // Validate inputs
  if (description === '' || isNaN(amount)) {
    alert('Please enter valid description and amount.');
    return;
  }

  const transaction = { description, amount, type };
  transactions.push(transaction);

  // Save to LocalStorage
  localStorage.setItem('transactions', JSON.stringify(transactions));

  // Update the UI
  updateUI();

  // Clear inputs
  descriptionInput.value = '';
  amountInput.value = '';
});

// Update UI with transactions and summary
function updateUI() {
  // Clear current transaction list
  transactionList.innerHTML = '';

  let totalIncome = 0;
  let totalExpense = 0;

  transactions.forEach((transaction, index) => {
    const listItem = document.createElement('li');
    listItem.classList.add(transaction.type);

    listItem.innerHTML = `
      ${transaction.description}: $${transaction.amount.toFixed(2)}
      <button class="delete" onclick="deleteTransaction(${index})">X</button>
    `;

    transactionList.appendChild(listItem);

    if (transaction.type === 'income') {
      totalIncome += transaction.amount;
    } else {
      totalExpense += transaction.amount;
    }
  });

  // Update budget, income, and expense
  const budget = parseFloat(budgetInput.value) || 0;
  incomeAmount.textContent = `$${totalIncome.toFixed(2)}`;
  expenseAmount.textContent = `$${totalExpense.toFixed(2)}`;
  remainingBudget.textContent = `$${(budget - totalExpense).toFixed(2)}`;
}

// Delete transaction
function deleteTransaction(index) {
  transactions.splice(index, 1);
  localStorage.setItem('transactions', JSON.stringify(transactions));
  updateUI();
}

// Initial UI update
updateUI();
