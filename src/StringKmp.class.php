<?php

namespace xiange\string;
//KMP 算法基类

class StringKmp {
	public static function mynext($str)
	{
		$next = array();
		$strlen = strlen($str);
		$i = 0;
		$j = -1;
		$next[$i] = $j;
		//abacabd
		/*
		$next[1] = 0;
		i = 1, j = 0; j = $next[j]; j = -1; $next[2] = 0;
		i = 2, j = 0; $next[3] = 1;
		i = 3, j = 1; c!=b, j = $next[1], j = 0, c != a j = -1, $next[4] = 0;

		*/
		while($i < $strlen-1)
		{
			if($j == -1 || $str[$i] == $str[$j])
			{
				if($str[++$i] == $str[++$j])
				{
					$next[$i] = $next[$j];
				}
				else
				{
					$next[$i] = $j;
				}
			}
			else
			{
				$j = $next[$j];
			}
		}
		return $next;
	}

	public static function getpos($str1, $str2)
	{
		$len1 = strlen($str1);
		$len2 = strlen($str2);

		$next = self::mynext($str2);
		$i = 0;
		$j = 0;
		while($i < $len1 && $j < $len2)
		{
			if($j == -1 || $str1[$i] == $str2[$j])
			{
				$i++;
				$j++;
			}
			else
			{
				$j = $next[$j];
			}
		}
		if($j == $len2)
		{
			return $i - $j;
		}
		return -1;
	}
}