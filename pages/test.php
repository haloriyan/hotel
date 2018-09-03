<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
</head>
<body>

<script src="https://www.gstatic.com/firebasejs/4.12.1/firebase.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.12.1/firebase-firestore.js"></script>	
<script>
	firebase.initializeApp({
		apiKey: 'AIzaSyAqDW6-KZSKq38_r6Z_XMHyQ99TcOsikU8',
		authDomain: 'belajar-ngeweb-id.firebaseapp.com',
		projectId: 'belajar-ngeweb-id'
	})

	var db = firebase.firestore();

	db.collection("users").get().then((querySnapshot) => {
		querySnapshot.forEach((doc) => {
			console.log('${doc.id} => ${doc.nama()}')
			// console.log(doc.nama)
		})
	})
</script>
</body>
</html>