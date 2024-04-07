<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Motore-Square</title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    />
    <style>
      label.error::before{
        content:'\*';
        white-space:pre;
      }
      label.error {
  color:red;

}
#password-error {
  position: absolute;
  top:40px;
}
#password-error::after{
  content: "\a";
    white-space: pre;
}
#confirmpassword-error {
  position: absolute;
  top:40px;

}
#remember-error {
  position:absolute;
  top: 100px;

}

</style>
</head>
<body>