var server = require('http').Server();
var io = require('socket.io')(server);
var Redis = require('ioredis');
var redis = new Redis();

redis.subscribe('notify');

redis.on('message', function (channel, message) {
  io.emit(channel + ':' + message);
});

server.listen(3000, (err) => {
  if (err) {
    console.log(err);
  }
  console.log('Server is listening to 3000');
});
