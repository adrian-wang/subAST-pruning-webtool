<head>
<title>SubAST pruning tool</title>
<link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon">
<script>
function jsfunction(x)
{
  if (document.getElementById('label+'+x).style.color == 'rgb(255, 0, 0)') {
    document.getElementById('label+'+x).style.color = '#000000';
    document.getElementById('label+'+x).style.background='#FFFFFF';
    document.getElementById('label-'+x).style.color = '#000000';
    document.getElementById('label-'+x).style.background='#FFFFFF';
  } else {
    document.getElementById('label+'+x).style.color='#FF0000';
    document.getElementById('label+'+x).style.background='#00FF00';
    document.getElementById('label-'+x).style.color='#FF0000';
    document.getElementById('label-'+x).style.background='#00FF00';
  }
}
</script>
</head>
<body>
<?PHP
$data = $_POST["stringtree"];
?>
<form action="index.php" method="post">
		<div id="form">
		<fieldset>
			StringTree:<br> 
			<textarea cols="100" rows="5" name="stringtree"><?PHP echo $data; ?></textarea>
			<div id="dianji">
				<button id="btn" type="submit"> begin </button>
			</div>
		</fieldset>
		</div>
	</form>
<form>
<?PHP
if (strlen($data) !== 0) {
	$count = 0;
	$prefix1 = "<label id=\"label";
	$prefix2 = "\" onclick=\"jsfunction(";
	$prefix3 = ")\">";
	$postfix = "</label>";
	echo "<h1>try click on the bracket!<br></h1>";
	$stack = new mystack();
	for ($i=0; $i<strlen($data); $i++) {
		$out = $data[$i];
		if ($out !== '[' && $out !== ']') {
			echo $out;
		} else if ($out === '[') {
			$stack->push($count);
			echo $prefix1."+".$count.$prefix2.$count.$prefix3;
			echo $out.$postfix;
			$count++;
		} else if ($out === ']') {
			if ($stack->isEmpty() === 1) {
				echo "<h2>not match!</h2>";
				die();
			}
			$match = $stack->pop();
			echo $prefix1."-".$match.$prefix2.$match.$prefix3;
		        echo $out.$postfix;
		}
	}
	if ($stack->isEmpty() === 0) {
		echo "<h2>not match!!</h2>";
		die();
	}
	$count = 0;
}
class mystack{
	private $top=-1;
	private $stack=array();
	public function isEmpty() {
		if ($this->top==-1)
			return 1;
		else
			return 0;
	}
	public function push($data) {
		$this->stack[++$this->top]=$data;
	}
	public function pop() {
		$ret = $this->stack[$this->top];
		unset($this->stack[$this->top--]);
		return $ret;
	}
}
?>
</form>
</body>
