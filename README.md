#MessageMe

## Install
> **Composer**
> ```
> require randomphp/message-me
>```

## Usage
>```php
><?php
>Use RandomPhp\MessageMe;
> 
>//setting the name of the session used to store the messages.
>MessageMe::$messageSessionName = 'tester';
> 
>// loading the messages from the session.
>$messages = MessageMe::loadMessages();
>```
>Loading messages only loads the messages that is already set not the ones set later.
>```php
><?php
>// Adding a new message to the session.
>MessageMe::addMessage('Something went wrong');
> 
>// Getting the messages.
>$messages->getMessages();//<- returns all messages
>```
>####Positions
>You can also use positions if you have more than one message being displayed on the screen at once.
>
>```php
><?php
>$messages = MessageMe::loadMessages();
> 
>// One possition can have multible messages on it.
>MessageMe::addMessage('Something went wrong','aboveLogin');
>MessageMe::addMessage('Do not do that!','aboveLogin');
> 
>// Returns an array with all the messages on the given position.
>$messages->getMessages('aboveLogin');
>```
>####Attributes
>Attributes can be used as a modifier for the messages if you have different types of messages.
>Attributes serves no other purpose than you can check for them or get their value.
>```php
><?php
>MessageMe::addMessage('Something went wrong','aboveLogin',['error' => true]);
>```
>####Use Case #1
>```php
><?php
>Use RandomPhp\MessageMe as Msg;
> 
>$loginCheck = false;
> 
>$msgs = Msg::loadMessages();
> 
>if(!empty($_POST) && !$loginCheck){
>    Msg::addMessage('Login was not successful','aboveLogin');
>    header('location: index.php');
>}
>?>
><!doctype html>
><html lang="en">
><head>
>    <meta charset="UTF-8">
>    <meta name="viewport"
>          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
>    <meta http-equiv="X-UA-Compatible" content="ie=edge">
>    <title>Document</title>
></head>
><body>
>   <?php if(count($msgs->getMessages('aboveLogin')) != 0){
>      foreach($msgs->getMessages('aboveLogin') as $msg){
>          echo $msg.'<br/>';
>      } 
>   
>} ?>
>    <form action="" method="POST">
>        <input type="text" name="username" placeholder="Username"/>
>        <input type="password" name="password" placeholder="Password"/>
>    </form>
></body>
></html>
>```