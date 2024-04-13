<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>運動記録</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
                background-color: #f5f5f5;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                border-radius: 8px;
                background-color: #fff;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
            h1 {
                color: #333;
                margin-top: 0;
                margin-bottom: 20px;
                text-align: center;
            }
            form {
                margin-bottom: 20px;
            }
            label {
                display: block;
                margin-bottom: 5px;
                color: #333;
                font-weight: bold;
            }
            input[type="text"],
            input[type="number"] {
                width: 100%;
                padding: 10px;
                margin-bottom: 10px;
                border-radius: 4px;
                border: 1px solid #ccc;
            }
            input[type="submit"] {
                width: 100%;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                background-color: #007bff;
                color: #fff;
                cursor: pointer;
            }
            input[type="submit"]:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>運動記録</h1>
            
            <form>
                <label for="record_type">運動の種目:</label>
                <input type="text" id="record_type" name="record_type" required>
                
                <label for="record_weight">重量 (kg):</label>
                <input type="number" id="record_weight" name="record_weight" required>
                
                <label for="record_times">挙上回数 (Reps):</label>
                <input type="number" id="record_times" name="record_times" required>
                
                <label for="record_sets">セット数:</label>
                <input type="number" id="record_sets" name="record_sets" required>
                
                <label for="record_movement_times">運動時間 (分):</label>
                <input type="number" id="record_movement_times" name="record_movement_times" required>
                
                <input type="submit" value="記録する">
            </form>
        </div>
    </body>
</html>
