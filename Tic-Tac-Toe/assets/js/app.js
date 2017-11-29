/* put any js-code here */
var gameOperate ={
    peopleStep:[],
    pcStep:[],
    clickflag:true,
    successflag:true,
    timedsq:null,
    gameNum:{
        1:"",
        2:"",
        3:"",
        4:"",
        5:"",
        6:"",
        7:"",
        8:"",
        9:""
    },
    init:function(){
        var _this =this;
        _this.timeupdate();
        //刷新页面初始化绑定
        $(".game").find("button[disabled]").each(function(){
            var id =$(this).data("id");
            if($(this).hasClass("o")){
                _this.gameNum[id]="o";
                _this.peopleStep.push(id);
                _this.successTips("o");
            }
            if($(this).hasClass("x")){
                _this.gameNum[id]="x";
                _this.pcStep.push(id);
                _this.successTips("x");
            }
        })

        //人下棋点击事件
        $(".game").on("click",".img_tic",function(){
            if($(this).attr("disabled")){
                return false
            }else{
                if(!_this.clickflag || !_this.successflag){
                    return false;
                }
                _this.clickflag=false;
                $(this).addClass("o");
                var id=$(this).data("id");
                $.get("gameOperate.php",{act:"peopleclick",id:id,status:1},function(res){
                    if(res.status){
                        console.log(res.mes);//输出成功提示
                        _this.peopleStep.push(id);
                        _this.gameNum[id]="o";
                        _this.successTips("o");
                    }
                },"json")
                    .done(function(){
                        if(!_this.successflag){
                            return false;
                        }
                        setTimeout(function(){
                            //调用机器随机步数算法
                           var computerstep= _this.fliter();
                           console.log(computerstep);
                           $(".game").find("#"+computerstep).addClass("x");
                           $.get("gameOperate.php",{act:"peopleclick",id:computerstep,status:2},function(res){
                               console.log(res);
                               if(res.status){
                                   _this.pcStep.push(computerstep);
                                   _this.gameNum[computerstep]="x";
                                   _this.successTips("x");
                                   _this.clickflag=true;
                               }
                           },"json");
                        },2000)//2s之后，机器自动下棋
                    })
            }
        })
    },
    fliter:function(){//电脑随机下棋算法,简单傻瓜随机式算法
        var _this =this;
        console.log(_this.gameNum);
        var emptySquare =[];
        $.each(_this.gameNum,function(index,item){
            if(item==""){
                emptySquare.push(index);
            }
        });
        var computerindex=emptySquare[Math.floor(Math.random() * (emptySquare.length - 1))];
        console.log(emptySquare);
        return computerindex;
    },
    tipscontent:function(type){
        var _this =this;
        if(type=="o"){
            var htmlTips ='<article class="alert">You Win!!</article>';
            $(".alert-spacing").html(htmlTips);
            $("#confirmnames").show();
            //隐藏字段赋值
            $("#time").val($(".dates").children(".time").text());
            $("#peoplestep").val(_this.peopleStep.length);
            $("#computerstep").val(_this.pcStep.length);
            clearTimeout(_this.timedsq);
            _this.successflag=false;
            return false;
        }else if(type=="x"){
            var htmlTips ='<article class="alert errortips">Computer Win!!</article>';
            $(".alert-spacing").html(htmlTips);
            _this.successflag=false;
            clearTimeout(_this.timedsq);
            return false;
        }else{
            var htmlTips ='<article class="alert yellow">本次平局!!</article>';
            $(".alert-spacing").html(htmlTips);
            _this.successflag=false;
            clearTimeout(_this.timedsq);
            return false;
        }
    },
    successTips:function(type){//判断游戏成功提示操作
        var _this =this;
        if(_this.gameNum[1] ==type && _this.gameNum[2] ==type && _this.gameNum[3] ==type){
            _this.tipscontent(type);
        }else if(_this.gameNum[4] ==type && _this.gameNum[5] ==type && _this.gameNum[6] ==type){
            _this.tipscontent(type);
        }else if(_this.gameNum[7] ==type && _this.gameNum[8] ==type && _this.gameNum[9] ==type){
            _this.tipscontent(type);
        }else if(_this.gameNum[1] ==type && _this.gameNum[4] ==type && _this.gameNum[7] ==type){
            _this.tipscontent(type);
        }else if(_this.gameNum[2] ==type && _this.gameNum[5] ==type && _this.gameNum[8] ==type){
            _this.tipscontent(type);
        }else if(_this.gameNum[3] ==type && _this.gameNum[6] ==type && _this.gameNum[9] ==type){
            _this.tipscontent(type);
        }else if(_this.gameNum[1] ==type && _this.gameNum[5] ==type && _this.gameNum[9] ==type){
            _this.tipscontent(type);
        }else if(_this.gameNum[3] ==type && _this.gameNum[5] ==type && _this.gameNum[7] ==type){
            _this.tipscontent(type);
        }else{
            if(_this.peopleStep.length==5){
                _this.tipscontent("no");
            }
        }
    },
    timeupdate:function(){
        var _this =this;
        var secd=0;
        function countSecond(){
            secd++;
            $(".dates").children(".time").html(secd+"sec");
            if(secd>59){
                secd=secd-60;
            }
            _this.timedsq=setTimeout(countSecond,1000);
        }
        countSecond();
        if($("#confirmnames").is(":visible")){
            clearTimeout(_this.timedsq);
        }

    },
    checkForm:function(){
        if($.trim($("#nickname").val())==""){
            $("#nicknameerrorTips").show();
            return false;
        }else{
            $("#nicknameerrorTips").hide();
            return true;
        }
    }
}

gameOperate.init();
