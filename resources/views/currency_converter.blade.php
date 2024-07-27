<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Converter</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="w-full max-w-md">
    <div class="bg-white shadow-md rounded px-8 py-6 mb-4">
        <h2 class="text-2xl font-bold mb-6 text-center">Currency Converter</h2>
        <form id="currency-form">
            @csrf
            <div class="mb-4">
                <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Amount</label>
                <input type="text" id="amount" name="amount" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label for="from_currency" class="block text-gray-700 text-sm font-bold mb-2">From Currency</label>
                <select id="from_currency" name="from_currency" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="">Select Currency</option>
                    <option value="USD">USD - US Dollar</option>
                    <option value="EUR">EUR - Euro</option>
                    <option value="GBP">GBP - British Pound</option>
                    <option value="JPY">JPY - Japanese Yen</option>
                    <option value="AUD">AUD - Australian Dollar</option>
                    <option value="CAD">CAD - Canadian Dollar</option>
                    <option value="CHF">CHF - Swiss Franc</option>
                    <option value="CNY">CNY - Chinese Yuan</option>
                    <option value="SEK">SEK - Swedish Krona</option>
                    <option value="NZD">NZD - New Zealand Dollar</option>
                    <!-- Add more currencies as needed -->
                </select>
            </div>
            <div class="mb-4">
                <label for="to_currency" class="block text-gray-700 text-sm font-bold mb-2">To Currency</label>
                <select id="to_currency" name="to_currency" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="">Select Currency</option>
                    <option value="USD">USD - US Dollar</option>
                    <option value="EUR">EUR - Euro</option>
                    <option value="GBP">GBP - British Pound</option>
                    <option value="JPY">JPY - Japanese Yen</option>
                    <option value="AUD">AUD - Australian Dollar</option>
                    <option value="CAD">CAD - Canadian Dollar</option>
                    <option value="CHF">CHF - Swiss Franc</option>
                    <option value="CNY">CNY - Chinese Yuan</option>
                    <option value="SEK">SEK - Swedish Krona</option>
                    <option value="NZD">NZD - New Zealand Dollar</option>
                    <!-- Add more currencies as needed -->
                </select>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Convert
                </button>
            </div>
        </form>
        <div id="loading" class="mt-4 text-center hidden">Loading...</div>
        <div id="result" class="mt-4 text-center"></div>
    </div>
</div>

<script>
document.getElementById('currency-form').addEventListener('submit', function(e) {
    e.preventDefault();

    document.getElementById('loading').classList.remove('hidden');
    document.getElementById('result').innerHTML = '';

    const amount = document.getElementById('amount').value;
    const from_currency = document.getElementById('from_currency').value;
    const to_currency = document.getElementById('to_currency').value;

    axios.post('/convert', {
        amount: amount,
        from_currency: from_currency,
        to_currency: to_currency
    })
    .then(function (response) {
        document.getElementById('loading').classList.add('hidden');
        const data = response.data;
        document.getElementById('result').innerHTML = `${data.amount} ${data.from_currency} is equal to ${data.converted_amount} ${data.to_currency}`;
    })
    .catch(function (error) {
        document.getElementById('loading').classList.add('hidden');
        document.getElementById('result').innerHTML = 'Error: ' + error.message;
    });
});
</script>

</body>
</html>
