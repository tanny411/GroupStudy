var canvas=document.querySelector('canvas');

canvas.width=window.innerWidth;
canvas.height=window.innerHeight;

var c=canvas.getContext('2d');

window.addEventListener('resize',function(){
    canvas.width=window.innerWidth;
    canvas.height=window.innerHeight;
});

// //rect
// c.fillStyle='rgba(255,0,0,.1)';
// c.fillRect(100,100,100,500);

// //line
// c.beginPath();
// c.moveTo(10,100);
// c.lineTo(300,400);
// c.lineTo(200,200);
// c.strokeStyle="pink";
// c.stroke();

// //arc /circle
// c.beginPath();
// c.arc(300,300,50,0,Math.PI*2,false);
// c.stroke();

// for(var i=0;i<14;i++){
//     var x=Math.random()*window.innerWidth;
//     var y=Math.random()*window.innerHeight;
//     c.beginPath();
//     c.arc(x,y,50,0,Math.PI*2,false);
//     c.stroke();
// }

var maxRadius=30;
var minRadius=5;
var colors=[
    '#231651','#4dccbd','#boddf4','#2374ab','#ff6060',
];

var mouse = {
    x: undefined,
    y: undefined
}
window.addEventListener('mousemove',function(event){
    mouse.x=event.x;
    mouse.y=event.y;
});
//circle object
function Circle(x,y,dx,dy,radius,color){
    this.x=x;
    this.y=y;
    this.dx=dx;
    this.dy=dy;
    this.radius=radius;
    this.minR=radius;
    this.color=color;

    this.draw=function(){
        c.beginPath();
        c.arc(this.x,this.y,this.radius,0,Math.PI*2,false);
        c.fillStyle=this.color;
        c.fill();
    }

    this.update=function(){
        if(this.x+this.radius>innerWidth || this.x-this.radius<0){
            this.dx=-this.dx;
        }
        this.x+=this.dx;
        if(this.y+this.radius>innerHeight || this.y-this.radius<0){
            this.dy=-this.dy;
        }
        this.y+=this.dy;

        //interactivity
        if( Math.abs(mouse.x-this.x)<50 && Math.abs(mouse.y-this.y)<50 ){
            if(this.radius<maxRadius) this.radius++;
            //console.log(Math.abs(mouse.x-this.x)+"   "+Math.abs(mouse.y-this.y));
        }
        else{
            this.radius=Math.max(this.minR,this.radius-1);
        }
        //draw
        this.draw();
    }
}

//anmation
// var x=Math.random()*innerWidth;
// var y=Math.random()*innerHeight;
// var dx=(Math.random()-0.5)*10;
// var dy=(Math.random()-0.5)*10;
// radius =30;

var circleArray=[];

for(var i=0;i<600;i++){
    var radius=(Math.random()*(minRadius-1))+1;
    console.log(radius);
    var x=Math.random()*(innerWidth-radius*2)+radius;
    var y=Math.random()*(innerHeight-radius*2)+radius;
    var dx=(Math.random()-0.5)*2;
    var dy=(Math.random()-0.5)*2;
    var color=colors[Math.floor(Math.random()*colors.length)];
    //console.log(color);
    circleArray.push(new Circle(x,y,dx,dy,radius,color));
}

function animate(){
    requestAnimationFrame(animate);
    c.clearRect(0,0,innerWidth,innerHeight);

    for(var i=0;i<circleArray.length;i++){
        circleArray[i].update();
    }
}

animate();
