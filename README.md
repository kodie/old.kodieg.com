# ![](/assets/img/favicon.png?raw=true) [kodieg.com](http://kodieg.com)
This is my personal website complete with copies of my resume and links to my various social networks. :sunglasses:

### Build
```
npm install
gulp build
```

### BrowserSync
```
gulp bs --proxy=http://kodieg.localhost
```

### Deploy
```
gulp deploy --host=FTP_HOST --port=FTP_PORT --user=FTP_USER --pass=FTP_PASSWORD
```
*To change which files are deployed to the server, edit the `ftpConfig.files` glob array inside of `gulpfile.js`.*
