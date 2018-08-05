  var character = document.head.querySelector("meta[character]").getAttribute('character');
  var conn = new WebSocket('ws://localhost:8080/game');
 conn.onmessage = function(e) { console.log(e.data); };
 conn.onopen = function(e) { conn.send(JSON.stringify({
 	'route':'character',
 	'action': 'get',
 	'key': character
 })); };