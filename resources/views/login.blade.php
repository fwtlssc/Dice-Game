<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <form action="{{route('login')}}" method="POST">
    @csrf
    <input type="text" name="userName">
    <input type="password" name="password">
    <button type="submit">Click me</button>
  </form>
  {{json_encode($errors->all())}}  
  <br>
  {{json_encode(request()->session()->all())}}  

</body>
</html>