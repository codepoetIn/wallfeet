<?php 
class ArrayUtils {
	
	public static function mergeArray($a,$b)
	{
		///$count=count($a);
		foreach($b as $k=>$v)
		{
			//if($k>1 && $k)
			
			$a[$k]=$v;
			
			//echo $a[$k]."\n";

		}

		return $a;
	}
	public static function joinArray($a,$b)
		{
			$count=count($a);
			foreach($b as $k=>$v)
			{
				//if($k>1 && $k)
				
				$a[$count+1+$k]=$v;
				
				//echo $a[$k]."\n";
	
			}
	
			return $a;
	}
	
}

?>