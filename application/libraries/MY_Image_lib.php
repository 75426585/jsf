<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @description CI图像处理类库扩展类，用以实现实际业务逻辑
 * @author  yanyalong
 */
class MY_Image_lib extends CI_Image_lib{
	public function __construct(){
		parent::__construct();
	}
	/**
	 *author:yanyalong
	 *description:修剪图片
	 *param:$x:左侧修剪实际像素
	 *param:$y:上侧修剪实际像素
	 *param:$w:裁切后图片实际宽度
	 *param:$h:裁切后图片实际高度
	 **/
	public function img_crop($source_img,$x,$y,$cutwidth,$cutheight){
		$imginfo = getimagesize($source_img);
		$config['source_image'] = $source_img;
		$config['x_axis'] = $x;
		$config['y_axis'] = $y; 
		$config['width'] = $cutwidth;
		$config['height'] = $cutheight;
		$config['image_library'] = 'gd2';
		$config['maintain_ratio'] =false;
		$this->initialize($config);
		if(!$this->crop()){
			return false;
		}else{
			return $source_img;
		}
	}
	/**
	 *author:yanyalong
	 *description:等比例裁切图片
	 **/
	function resizeimage($sourceimg,$toimg,$towidth,$toheight=''){
		$imginfo = getimagesize($sourceimg);
		$config['image_library'] = 'gd2';
		$config['source_image'] = $sourceimg;
		$config['maintain_ratio'] = TRUE;
		$config['new_image'] = $toimg;
		if($toheight!=''){
			$config['width'] = $towidth;
			$config['height'] = $toheight;
			//根据宽高缩放比例判断缩放依赖主轴，以比例低的为准
			if(($imginfo['0']/$towidth)>($imginfo['1']/$toheight)){
				$config['master_dim'] = 'height';
			}else{
				$config['master_dim'] = 'width';
			}
		}else{
			$config['master_dim'] = 'width';
			$config['width'] = $towidth;
			$config['height']= $imginfo[1]/($imginfo[0]/$towidth);	
		}
		$this->initialize($config);
		if($this->resize()){
			//$this->img_rotation($sourceimg,90);
			if($toheight!=''){
				$config['maintain_ratio'] = FALSE;
				$config['source_image'] = $config['new_image'];
				$thumb_info = getimagesize($config['new_image']);
				//新图片切割坐标
				if($thumb_info[0]>=$thumb_info[1]){
					$cutwidth = ($thumb_info[0]-$towidth)/2;
					$cutheight = 0;
				}else{
					$cutheight = ($thumb_info[1]-$toheight)/2;
					$cutwidth = 0;
				}
				$this->initialize($config);
				$cropflag = $this->img_crop($config['new_image'],$cutwidth,$cutheight,$towidth,$toheight);
				if($cropflag==false){
					return false;
				}else{
					return true;
				}
			}else{
				return true;
			}
		}else{
			return false;
		}
	}
	/**
	 *author:yanyalong
	 *description:旋转图片
	 *param:$rotaion_angle:旋转角度
	 **/
	public function img_rotation($source_img,$rotation_angle){
		$config['source_image'] = $source_img;
		$config['rotation_angle'] =$rotation_angle;
		$this->initialize($config);
		if(!$this->rotate()){
			return false;
		}else{
			return $source_img;
		}
	}
}	
