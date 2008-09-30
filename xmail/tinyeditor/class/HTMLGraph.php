<?php
/*
 * Class:        HTMLGraph
 * Version:      1.0
 * Date:         July 18
 * Author:       Jose Rafael Carrero Leon (josercl@gmail.com)
 * Licence       Free for non-commercial use
 */
class HTMLGraph{
	var $series_values; // Array, This contains the values of each serie
	var $series_colors; // Array, contains the background colors of each bar in the graph
	var $series_labels; // Array, Labels of each bar
	var $isPercentage; // boolean, determines if the values of each series are percentages or just numbers
	var $width; // number, especifies the width of the graph
	var $bar_height; //number, bar heigt 
	//var $title; //string, the title of the graphic
	
	/* Constructor */
	function HTMLGraph(){
		$this->series_values=Array();
		$this->series_colors=Array();
		$this->series_labels=Array();
		$this->width=100;
		$this->bar_height=100;
		$this->isPercentage=true;
		$this->title="";
	}
	
	/* Sets the graphic title */
	/*function setTitle($title){
		$this->title=$title;
	}*/
	
	/* adds a serie to the bar graph, with the specified value, background color and label*/
	function addSerie($value,$color="#FFFFFF",$label=""){
		$this->series_values[]=$value;
		$this->series_colors[]=$color;
		$this->series_labels[]=$label;
	}
	
	/* Defines the width of the graph */
	function setWidth($width){
		$this->width=$width;
	}

	/* Defines the width of the bar */
	function setBarHeight($bar_height){
		$this->bar_height=$bar_height;
	}
	
	/* Determines if the series are percentage values */
	function isPercentage($p){
		$this->isPercentage=$p;
	}
	
	/* if the values of the series are NOT percentages, this calculates the
	 * percentage corresponding to the value passed as parameter
	 */
	function calculatePercentage($value){
		$total=0;
		for($i=0;$i<sizeof($this->series_values);$i++){
			$total+=$this->series_values[$i];
		}
		return $value*100/$total;
	}
	
	/* draws a bar with the corresponding value and background color */
	function drawBar($value,$bgcolor){
		if($this->isPercentage){
			$width=$value;
			$text=$width."%";
		}else{
			$width=round($this->calculatePercentage($value),2);
			$text=$value;
		}

		/*if($width >=75 && $width <100){
			$bgcolor = "#ffc21f";
		} elseif ($width =100){
			$bgcolor = "#ff6f6f";
		}*/

		if($width!=100){
			echo "<td width='".$width."%' height='".$this->bar_height."px' bgcolor='".$bgcolor."' style='border: 1px solid #a7a7a7;font: 10px sans-serif;vertical-align: middle;text-align: center;'></td>";
			echo "<td width='".(100-$width)."%' style='font: 10px sans-serif;vertical-align: middle;text-align: left;'>&nbsp;".$text."&nbsp;</td>";
		}else{
			echo "<td width='".$width."%' height='".$this->bar_height."px' bgcolor='".$bgcolor."' style='border: 1px solid #a7a7a7;font: 10px sans-serif;vertical-align: middle;text-align: center;'>&nbsp;".$text."&nbsp;</td>";
		}
	}
	
	/* Shows the graphic in the page */
	function display(){
		echo "<table border=0 width='".$this->width."' cellpadding=0 cellspacing=0>";
			/*if($this->title!=""){
			echo "<tr><td colspan='2' style='text-align: left;vertical-align: middle;font: 11px sans-serif'>".$this->title."</td></tr>";
			}*/
			echo "<tr>";
			for($i=0;$i<sizeof($this->series_values);$i++){
				if($this->series_values[$i]==0 or $this->series_values[$i]==100) {
					$this->drawBar($this->series_values[$i],$this->series_colors[$i]);
				}elseif ($this->isPercentage) {
					$this->drawBar($this->series_values[$i],$this->series_colors[$i]);
				}
			}
			
			echo "</tr></table>";
	}
}
?>
