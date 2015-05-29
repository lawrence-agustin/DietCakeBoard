<html>
<head>
    <style>
        th, td {
            height: 30px;
        }
    </style>
</head>
<body> 
	<h4 style='margin-top:0; line-height:22px;'>User Details</h4>
    <table border="1" width="40%">
    	<tr><td><b><em>First Name</em></b> :</td> <td><?php readable_text($user_info['firstname']); ?></td> </tr>
        <tr><td><b><em>Middle Name</em></b> :</td> <td><?php readable_text($user_info['middlename']); ?> </td> </tr>
        <tr><td><b><em>Last Name</em></b> :</td> <td><?php readable_text($user_info['lastname']); ?> </td> </tr> 
        <tr><td><b><em>Username</em></b> :</td> <td><?php readable_text($user_info['username']); ?> </td> </tr> 
        <tr><td><b><em>Email Address</em></b> :</td> <td><?php readable_text($user_info['email']); ?></td></tr>
    </table>
         
    <br> 
</body>

</html>