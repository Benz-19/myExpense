<?php
if (!isset($_SESSION['user_state'])) {
    header('Location: /myExpense/login');
    exit;
}

use App\Http\Controllers\BalanceController;
use App\Http\Controllers\ExpenseController;

require_once __DIR__ . '/../../vendor/autoload.php';

$bal = new BalanceController();
$userBalance = $bal->getBalance($_SESSION['user_details']['user_id']);

$userBalance = ($userBalance >= 0.00) ? $userBalance : -$userBalance;
$balanceClass = $userBalance <= 0 ? 'text-red-500' : 'text-green-600';

// Today's cost
$expense = new ExpenseController();
$todayCost = $expense->getTodayCost($_SESSION['user_details']['user_id']);
$todayCost = $todayCost > 0 ? $todayCost : 0.00;
?>

<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>myExpense Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Enable dark mode via class strategy
        tailwind.config = {
            darkMode: 'class',
        };
    </script>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f9f9f9;
            /* Optional: light background */
        }
        
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 2rem;
        }

        .sidebar-logo {
            padding: 1.5rem;
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
        }

        .main-content {
            margin-left: 250px;
            padding: 2rem;
        }

        .expense-cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 16px;
            margin-top: 1rem;
        }
    </style>
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-300">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="sidebar bg-slate-800 text-gray-200 dark:bg-slate-900">
            <img src="<?php echo '/public/images/logo.png'; ?>" alt="logo">
            <div class="sidebar-logo">myExpense</div>
            <nav class="sidebar-nav">
                <a href="#" class="block py-2 px-4 text-sm hover:bg-gray-700">Home</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-gray-700">Products</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-gray-700">Statistics</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-gray-700">Inbox</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-gray-700">Notifications</a>
                <a href="/myExpense/logout">
                  <button class="mt-8 bg-red-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Logout</button>
                </a>
            </nav>
        </aside>

        <!-- Main content -->
        <div class="flex-1 overflow-y-auto">
            <header class="bg-white dark:bg-gray-800 shadow px-6 py-4 flex justify-between items-center">
                <div class="flex flex-col">
                    <h1 class="text-xl font-bold text-gray-800 dark:text-gray-100">Welcome <?php echo $_SESSION['user_details']['username']; ?>!</h1>
                    <h3 class="mt-10 text-xl font-bold <?php echo $balanceClass; ?> dark:text-gray-100">
                        <?php echo number_format($userBalance, 2); ?>
                    </h3>
                    <h4 class="mt-10 text-xl font-bold text-gray-800 dark:text-gray-100">Expenses</h4>
                </div>

                <div class="flex flex-col items-center gap-4">
                    <div class="flex items-center gap-4">
                        <input type="text" placeholder="Search expenses..."
                            class="p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                        <button onclick="toggleTheme()"
                            class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">Toggle
                            Theme</button>
                    </div>

                    <div class="flex items-center">
                        <h3 class="mt-10 text-xl font-bold text-green-600 dark:text-gray-100">Today's Expense = <?php echo $todayCost; ?></h3>
                    </div>
                </div>
            </header>

            <main class="main-content flex justify-around flex-wrap">
                <div class=" mt-8 mr-3 bg-white dark:bg-black-900 p-6 rounded shadow h-fit">
                    <form action="/myExpense/get_expenses" method="POST" class="flex flex-col">
                        <input type="number" class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white" name="amount" placeholder="0.00">
                        <button class="mt-8 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" name="sendAmount"> Update Balance</button>
                    </form>
                </div>

                <div id="input-section" class="bg-white dark:bg-gray-800 p-6 rounded shadow  h-fit mr-3">
                    <label for="itemCount" class="block text-sm font-medium mb-2">Number of Expenses:</label>
                    <input type="number" id="itemCount"
                        class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        min="1" value="1">
                    <button onclick="generateExpenseCards()"
                        class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Generate Expenses</button>
                    <div id="expense-cards" class="expense-cards-container mt-6"></div>
                </div>

            </main>
        </div>
    </div>

    <script>
        function toggleTheme() {
            const htmlEl = document.documentElement;
            htmlEl.classList.toggle('dark');
        }

        function generateExpenseCards() {
            const itemCount = parseInt(document.getElementById('itemCount').value);
            const expenseCardsContainer = document.getElementById('expense-cards');
            const submitSection = document.getElementById('submit-section');
            expenseCardsContainer.innerHTML = '';

            if (itemCount > 0) {
                let formHTML = '<form id="expenseForm" method="POST" action="/myExpense/submit_expenses">';
                for (let i = 0; i < itemCount; i++) {
                    formHTML += `
                        <div class="bg-white dark:bg-gray-800 border dark:border-gray-700 rounded p-4 shadow">
                            <h3 class="text-lg font-semibold mb-2">Expense #${i + 1}</h3>
                            <div class="mb-3">
                                <label for="category_${i}" class="block mb-1">Category:</label>
                                <select id="category_${i}" name="category_${i}"
                                    class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option value="telephone">Telephone</option>
                                    <option value="shopping">Shopping</option>
                                    <option value="health">Health</option>
                                    <option value="gym">Gym</option>
                                    <option value="utilities">Utilities</option>
                                    <option value="transportation">Transportation</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="description_${i}" class="block mb-1">Description:</label>
                                <input type="text" id="description_${i}" name="description_${i}"
                                    class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            </div>
                            <div class="mb-3">
                                <label for="date_${i}" class="block mb-1">Date:</label>
                                <input type="date" id="date_${i}" name="date_${i}"
                                    class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            </div>
                            <div class="mb-3">
                                <label for="price_${i}" class="block mb-1">Price:</label>
                                <input type="number" id="price_${i}" name="price_${i}" step="0.01"
                                    class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            </div>
                        </div>
                    `;
                }
                formHTML += `
                <div class="submit-button-container mt-8">
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Submit Expenses
                    </button>
                </div>
                `;
                formHTML += '</form>';

                expenseCardsContainer.innerHTML = formHTML;
                submitSection.classList.remove('hidden');
                document.getElementById('input-section').classList.add('hidden');
            } else {
                expenseCardsContainer.innerHTML = '<p class="text-red-500">Please enter a valid number of expenses.</p>';
                submitSection.classList.add('hidden');
                document.getElementById('input-section').classList.remove('hidden');
            }
        }

        function submitExpenses() {
            const form = document.getElementById('expenseForm');
            const formData = new FormData(form);
            const expensesData = [];

            for (let i = 0; formData.has(`category_${i}`); i++) {
                expensesData.push({
                    category: formData.get(`category_${i}`),
                    description: formData.get(`description_${i}`),
                    date: formData.get(`date_${i}`),
                    price: parseFloat(formData.get(`price_${i}`))
                });
            }

            console.log("Expenses Data:", expensesData);
            alert("Expenses submitted (check console for data)!");

            document.getElementById('expense-cards').innerHTML = '';
            document.getElementById('submit-section').classList.add('hidden');
            document.getElementById('input-section').classList.remove('hidden');
            document.getElementById('itemCount').value = 1;
        }
    </script>
</body>

</html>
