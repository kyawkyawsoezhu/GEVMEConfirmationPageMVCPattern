# GEVMEConfirmationPageMVCPattern
MVC pattern, especially for GEVME custom confirmation page

### First Install Composer (obviously)
```
composer install
```

### Create Envirount environment
```
copy '.env.default' to .env
```

### How Route work
```
www.example.com/class/method/argument1/argument2/.../
```
**Example:** \
`/confirm/send/janedoe@mail.com/JaneDoe` the URL will load `send` method in `ConfirmController` class with two parameters 
```
class ConfirmController{
    public function send($mail, $name)
    {
        . . . . . . .
    }
}
```
**Note:** `index` method will be loaded for default


### Available helper function

* view()
* config()
* console()
* pd()


### view()
**Description:** \
Load view file

**Example:** \
for loading file under `View/example/index.php` use `view('example.index')`, \
support passing variable to view from second parameter  `view('example.index',['title'=>'Hello World'])`


### config()
**Description:** \
Laravel-like config function, all config file are under `/config` folder,

**Example:** \
to get base url value in `config/api.php` use `config('api.base_url')`;

### console()
**Description:** \
Output debuging from javascript console.

**Example:** \
console($arr);

### pd()
**Description:** \
Print array pretty and call `die()` function

**Example:** \
pd($arr);


## There are some helpful Service under `/Services` folder


### APIService
**Description:** \
There are two method under this Class, `requestToken($api_grant_type)`, `request($url, $method, $access_token, $data)`

**Example**
```
$api_service = new APIService;
$access_token = $api_service->requestToken('client_credentials')['access_token'];
$invitee_url = config('api.base_url')."services/events/".config('event.id').'/invitees';
$api_service->request($invitee_url,'GET',$access_token, ['page'=>'2']
```


### MailService
**Description:** \
 Make sending email more easire.

**Example**
```
$mail = new MailService;
$to = "Kyaw Kyaw Soe <kyawkyaw@global-connect.asia>";
$subject = "Example Subject";
$mail->html('mail.example',['title'=>"Newsletter"])->send($to, $subject);
```
**Note:**  `html()` method use to load file under `/View` folder. 

##### Dive into the source code for better understanding.