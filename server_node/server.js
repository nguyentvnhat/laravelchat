var io = require('socket.io')(6001)
console.log('connected to port 6001')
io.on('error',function(socket){
	console.log('error');
})
io.on('connection',function(socket){
	console.log('User connected '+socket.id)
})

var Redis = require('ioredis');
var redis = new Redis(1400);

/**
 * Function return from RedisEvent
 * @param  {[type]} partner  : any item listen when someone connect
 * @param  {[type]} channel  : event return
 * @param  {[type]} message  : event response - 
 * @return {[type]}          [description]
 */
redis.psubscribe("*",function(error,count){
	// console.log(error);
	// console.log(count);
})
redis.on('pmessage',function(partner,channel,message){
	// console.log(channel);
	// console.log(messsage);
	// console.log(partner);
	message = JSON.parse(message)
	io.emit(channel+':'+message.event,message.data.message)
	console.log('sent');
})