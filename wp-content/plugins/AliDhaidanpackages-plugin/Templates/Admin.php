<h1> Weekly Packages </h1>

	<head> 
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="mystyle.css">
		<title>clinic details</title>
	</head>

<body>
	<img src="FBPrivategroupage.jpg">
<form action="clinicdetails.php" method="post">
		<label for="clinic">Please confirm selected Medical Centre: </label>
			<select id="clinic" name="clinic" size="1">
				<option value="health first">Health First</option>
				<option value="health point">Health Point(North Shore)</option>
				<option value="health point">Health Point(Parramatta)</option>
				<option value="green clinic">Green Clinic(Eastwood)</option>
				<option value="green clinic">Green Clinic(Chatswood)</option>
				<option value="bright health care">Bright Health Care</option>
				<option value="quick recovery">Quick Recovery</option>
				<option value="lightweight nutrition">Lightweight Nutrition</option>
				<option value="fast recovery">Fast Recovery</option>
				<option value="pain ease">Pain Ease(Camplbelltown)</option>
				<option value="pain ease">Pain Ease(Parramatta)</option>
				<option value="relief clinic">Relief Clinic</option>
				<option value="shining smile">Shining Smile</option>
				<option value="wonder ward">Wonder Ward</option>
				<option value="medireco">Medireco</option>
			</select><br>

			<label for="memberID">If you are a member please enter username. *OPTIONAL*:</label>
		<input type="text" id="memberID" name="memberID"><br>
		
		<p>If you are not a member, please fill out the form below.</p>
		<label for="pName">Patient Name:</label>
		<input type="text" id="pName" name="pName"><br>
		
		<label for="pNumber">Patient Contact Number:</label>
		<input type="text" id="pNumber" name="pNumber"><br>
		<p>
		<label for="medicalService">Please select all applicable appointment types:</label>
		<select id="medicalService" name="medicalService[]" size="5" multiple>
			<option value="Nutritional Support">Nutrition Support</option>
			<option value="Dental Care">Dental Care</option>
			<option value="Pharmaceutical">Pharmaceutical</option>
			<option value="Physical Therapy">Physical Therapy</option>
			<option value="Diagnosis Care">Diagnosis Care</option>
		</select>
		</p>
		<p>
		<label for="bookingDate">Please Select A Date:</label>
		<input type="date" id="bookingDate" name="bookingDate">
		</p>
		<p>
		<label for="bookingTime">Please Select A Time:</label>
		<input type="time" id="bookingTime" name="bookingTime">
		</p>
		<p>
		<input type="submit" value="submit"> &nbsp; <input type="reset" value="Reset">
		</p>

</body>