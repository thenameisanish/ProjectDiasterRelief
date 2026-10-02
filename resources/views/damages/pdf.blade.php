<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Damage Assessment Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { text-align: center; color: #dc3545; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f8f9fa; font-weight: bold; }
        .header { text-align: center; margin-bottom: 20px; }
        .header p { margin: 0; font-size: 14px; color: #555; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Disaster Relief System</h1>
        <p>Infrastructure Damage Assessment Report</p>
        <p>Date Generated: {{ date('Y-m-d H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Infrastructure</th>
                <th>Quantity</th>
                <th>Severity</th>
                <th>Location</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($damages as $damage)
            <tr>
                <td>{{ $damage->infrastructure_type }}</td>
                <td>{{ $damage->quantity }}</td>
                <td>{{ $damage->severity }}</td>
                <td>{{ $damage->location }}</td>
                <td>{{ $damage->description ?? 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>