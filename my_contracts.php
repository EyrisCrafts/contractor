<?php
// Load the contracts from the JSON file
$contractsFile = 'my_contracts.json';
$contracts = [];

// Check if the file exists and read it
if (file_exists($contractsFile)) {
    $contracts = json_decode(file_get_contents($contractsFile), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        die('Error parsing JSON file.');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Contracts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #ffffff;
            border-radius: 10px;
            padding: 20px 40px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .top-bar .left {
            flex: 1;
        }

        .top-bar .right {
            flex: 1;
            text-align: right;
        }

        h1 {
            font-size: 2rem;
            color: #333333;
            margin: 0;
            text-align: center;
        }

        .button {
            padding: 8px 16px;
            font-size: 0.9rem;
            color: #ffffff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .button.delete {
            background-color: #dc3545;
        }

        .button.delete:hover {
            background-color: #b52a37;
        }

        .contract-list {
            list-style: none;
            padding: 0;
        }

        .contract-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            margin: 10px 0;
            background-color: #f4f4f4;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .contract-item span {
            font-size: 1rem;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .top-bar {
                display: flex;
                flex-wrap: wrap;
            }

        }
    </style>
</head>

<body>
    <div class="container">
        <div class="top-bar">
            <div class="left">
                <a class="button" href="/">Home</a>
            </div>
            <div class="right">
                <a class="button" href="/generator/edit.html">New Contract</a>
            </div>
        </div>
        <h1>My Contracts</h1>
        <ul class="contract-list">
            <?php if (!empty($contracts)): ?>
                <?php foreach ($contracts as $contract): ?>
                    <li class="contract-item" data-id="<?php echo htmlspecialchars($contract['id']); ?>">
                        <span><?php echo htmlspecialchars($contract['name']); ?></span>
                        <div>
                            <a class="button" href="/generator/edit.html?id=<?php echo urlencode($contract['id']); ?>">Edit</a>
                            <a class="button delete" href="#" onclick="deleteContract('<?php echo htmlspecialchars($contract['id']); ?>'); return false;">Delete</a>
                        </div>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No contracts found.</p>
            <?php endif; ?>
        </ul>
    </div>
</body>
<script>
    function deleteContract(contractId) {
        if (!confirm('Are you sure you want to delete this contract?')) {
            return;
        }

        fetch('/delete_contract.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: contractId
                })
            })
            .then(response => {
                if (!response.ok) {
                    // Handle non-OK responses
                    return response.json().then(data => {
                        throw new Error(data.message || 'Failed to delete contract');
                    });
                }
                return response.json(); // Parse JSON for success responses
            })
            .then(data => {
                // Remove the contract from the list
                const contractItem = document.querySelector(`.contract-item[data-id="${contractId}"]`);
                if (contractItem) {
                    contractItem.remove();
                }

                // Show a success toast
                showToast('Contract successfully deleted');
            })
            .catch(error => {
                console.error('Error deleting contract:', error.message);
                showToast(error.message || 'An error occurred while deleting the contract', true);
            });

    }

    // Toast notification function
    function showToast(message, isError = false) {
        const toast = document.createElement('div');
        toast.textContent = message;
        toast.style.position = 'fixed';
        toast.style.bottom = '20px';
        toast.style.right = '20px';
        toast.style.padding = '10px 20px';
        toast.style.color = '#fff';
        toast.style.backgroundColor = isError ? '#dc3545' : '#28a745';
        toast.style.borderRadius = '5px';
        toast.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';
        toast.style.zIndex = '1000';
        toast.style.opacity = '1';
        toast.style.transition = 'opacity 0.3s ease';

        document.body.appendChild(toast);

        // Fade out and remove the toast after 3 seconds
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 3000);
    }
</script>

</html>