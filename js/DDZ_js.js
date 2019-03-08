
 //全局变量
  countp=new Array(15);//js区分大小写，Array不要写成array
  sfname=["","地主","下家","上家"];
  readname=["3","4","5","6","7","8","9","S","J","Q","K","1","2","X","D"];
  readdownname=-1;//选牌个数
  msf=0;//0无，1地主，2下家，3上家
  sfl=0;//按顺序该出现的身份
  sfg=0;//改变身份时用身份改
  count_choice_num=0;
  jp=new Array(15).fill(0);//记牌0-14:3-9,s,j,q,k-1,2,大小王
  //初始化
  function Initialise(){
   countp[14]=1;
   countp[13]=1;
   for(var i=0;i<13;i++)
   {
    countp[i]=4;
   }
  }
  ////主要方法
  function Information_main(sf){
	var boolin=true;//是否输入正确
    var content = document.getElementById("txt_information");
	var bagoutput = document.getElementById("output_information");
	
	//处理输入信息
	outstr=content.value;
	if(outstr=="")
		outstr="要不起";
	var readtemp=-1;
	if(sf==1){//按钮启用设置身份优先
		readtemp=input_read(content.value+"=",true);
	}else if(sf==2){
		readtemp=input_read(content.value+"[",true);
	}else if(sf==3){
		readtemp=input_read(content.value+"]",true);
	}else{
		readtemp=input_read(content.value,true);
	}
	switch(readtemp)
	{
	case 0:
		bagoutput.innerHTML="<p  id=outp class=p_red>>error</p>"+bagoutput.innerHTML;
		boolin=false;
		break;
	case 1://1代表新出
		if(sfl==msf)
		{
			bagoutput.innerHTML="<p  id=outp"+sfl+" class='p_red'>"+sfname[sfl]+">"+outstr+"</p>"+bagoutput.innerHTML;
		}else{
			bagoutput.innerHTML="<p  id=outp"+sfl+" class=p_small>"+sfname[sfl]+">"+outstr+"</p>"+bagoutput.innerHTML;
		}
		break;
	case 2://2代表更改
		var str3=document.getElementById("outp"+sfl).innerText,str4="";
			var i3=0;
			for(;str3[i3]!='>';i3++)
			{
				str4+=str3[i3];
			}
			for(;str3[i3]=='>';i3++)
			{
				str4+=str3[i3];
			}
			document.getElementById("outp"+sfl).innerText=str4+">"+outstr;
			str4="";
			for(;i3<str3.length;i3++)
			{
				str4+=str3[i3];
			}
			input_read(str4,false);//减原值
		
		break;
	}
	
	
	//智能算法
	
	//后续处理
	for(var i=0;i<15;i++)
	{
	 document.getElementById("count_"+i).innerText=countp[i];
	}
	bagoutput.scrollTop=0;//顶端//bagoutput.scrollHeight;//移动滚动条到最底端
	if(boolin){
		content.value="";//文本框清零
		document.getElementById("Show_information").innerText="";
		count_choice_num=0;
		document.getElementById("count_choice_num").innerText=count_choice_num;
		if(sfg>0){//如果改牌，sfg记录sfl下一次应该的状态
		sfl=sfg;
		sfg=0;	
		}else if(sfg==-1){//sfg同时记录是否第一次输入（录牌），是则下次一定是地主
			sfl=1;
			sfg=0;
		}else{
			sfl=sfl%3+1;//身份流循环
		}
	}
	
	
  }
  ////点击录入
  function click_readDown(inid){
	  //var tp=document.getElementById("readimg"+inid);
	  //try{
	  	//tp.className="Image_choic2";
	  //}catch(e){
		//tp.setAttribute('class', 'Image_choic2');
	  //}
	  readdownname=inid;
  }
  function click_readUP(inid){
	  var inf=document.getElementById("txt_information");
	  var btnNum = window.event.button;
	  if(readdownname==inid){//防止按下和抬起不在同一图片上
	  	if(btnNum==0&&window.event.shiftKey!=1){//点击左键
		  inf.value+=readname[inid];
		  jp[inid]++;
		  count_choice_num++;//选牌个数+1
	  	}else if(btnNum==2||btnNum==1||window.event.shiftKey==1){//点击右键||中键
		  var str=inf.value;
		  var str2="";
		  var i=str.length-1;
		  for(;i>=0;i--)
		  {
			if(str[i]==readname[inid])
			{
				break;
			}else{
				str2=str[i]+str2;
			}
		  }
		  for(i--;i>=0;i--)
		  	str2=str[i]+str2;
		  inf.value=str2;
		  if(jp[inid]>0){
			  count_choice_num--;
			  jp[inid]--;
		  }
		  
	  	}
		document.getElementById("Show_information").innerText=inf.value;
		document.getElementById("count_choice_num").innerText=count_choice_num;
	  }
	  readdownname=-1;
  }
  function Show_read(){//输入框文本改变方法（只有直接通过输入框手动改变oninput=""才有效）
	  var str=document.getElementById("txt_information").value
	  count_choice_num=str.length;
	  document.getElementById("Show_information").innerText=str;
	  document.getElementById("count_choice_num").innerText=count_choice_num;
  }
  function clear_read(){//清空
	  document.getElementById('txt_information').value='';
	  document.getElementById("Show_information").innerText="";
	  document.getElementById("count_choice_num").innerText=0;
	  count_choice_num=0;
  }
  function input_read(instr,add){//录入信息处理方法
		var sf=0;
		var inl=instr.length;
		var jpzs=0;//记输入的牌总数
		var jqb=-1;//对于-，记录前下标
		var lxs=false;
		for(var i=0;i<15;i++){
			jp[i]=0;
		}
		for(var i=0;i<inl;i++)
		{
			var c=instr[i];
			var js=-1;
			if(c-'0'>0&&'9'-c>=0)//3-9,1,2
			{
				js=(c-'0'+10)%13;
				if(add){jp[js]++;}else{jp[js]--;}
			}else if(c=='0'||c=='s'||c=='S')
			{
				jp[7]++;
				js=7;
			}else if(c=='j'||c=='J')
			{
				js=8;
				if(add){jp[js]++;}else{jp[js]--;}
			}else if(c=='q'||c=='Q')
			{
				js=9;
				if(add){jp[js]++;}else{jp[js]--;}
			}else if(c=='k'||c=='K')
			{
				js=10;
				if(add){jp[js]++;}else{jp[js]--;}
			}else if(c=='x'||c=='X')
			{
				jp[js=13]++;
			}else if(c=='d'||c=='D')
			{
				js=14;
				if(add){jp[js]++;}else{jp[js]--;}
			}else if(c=='=')
			{
				sf=1;
			}else if(c=='[')
			{
				sf=2;
			}else if(c==']')
			{
				sf=3;
			}else if(c=='-')//J-x=>j,q,k,1,2,x
			{
				lxs=true;
			}
			if(js>=0&&add)
			{
				if(lxs&&jqb>=0)
				{
					if(jqb<js) {
						for(var j=jqb+1;j<js;j++)
						{
							jp[j]++;
						}
					}else {
						for(var j=js+1;j<jqb;j++)
						{
							jp[j]++;
						}
					}
					lxs=false;
				}
				jqb=js;
			}
		}
		if(!add)
			return -1;
		for(var i=0;i<15;i++)
		{
			jpzs+=jp[i];
			if(countp[i]-jp[i]<0)
				return 0;//返回0表示错误
		}
		for(var i=0;i<15;i++)
		{
			countp[i]-=jp[i];
		}
		
		if(msf>0)
		{
			
		}else if(sf>0)
		{
			msf=sf;
			sfl=1;
			sfg=-1;
		}else if(jpzs==17)
		{
		//alert("2");//对话框///////////////////////
			msf=2;
			sfl=2;
			sfg=-1;
		}else if(jpzs==20){
			msf=1;
			sfl=1;
			sfg=-1;
		}else
		{
			return 0;
		}
		if(sf==sfl||sf==0){
			return 1;
		}else{
			sfg=sfl;
			sfl=sf;
			return 2;
		}
  }