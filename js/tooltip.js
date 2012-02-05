

	function showToolTip(e,text){
		if(document.all)e = event;
		
		var obj = document.getElementById('bubble_tooltip');
		var obj2 = document.getElementById('bubble_tooltip_content');
		obj2.innerHTML = text;
		obj.style.display = 'block';
		var st = Math.max(document.body.scrollTop,document.documentElement.scrollTop);
		if(navigator.userAgent.toLowerCase().indexOf('safari')>=0)st=0; 
		var leftPos = e.clientX - 100;
		if(leftPos<0)leftPos = 0;
		obj.style.left = leftPos + 'px';
		obj.style.top = e.clientY - obj.offsetHeight -1 + st + 'px';
	}	
	
	function hideToolTip()
	{
		document.getElementById('bubble_tooltip').style.display = 'none';
	}

