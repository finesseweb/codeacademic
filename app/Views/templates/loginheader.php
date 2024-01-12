<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

    <title>Academic login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/custom.css">


</head>

<body>
    <?php $uri = service('uri') ?>
    <?php $this->config = config('Auth');
    $redirect = $this->config->assignRedirect; ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Academic Login</a>


            
        </div>
    </nav>