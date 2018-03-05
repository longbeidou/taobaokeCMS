<?php

namespace App\Libraries\Alimama\top\request;

use App\Libraries\Alimama\top\RequestCheckUtil;

/**
 * TOP API: taobao.tbk.tpwd.create request
 *
 * @author auto create
 * @since 1.0, 2017.08.23
 */
class TbkTpwdCreateRequest
{
	/**
	 * 扩展字段JSON格式
	 **/
	public $ext;

	/**
	 * 口令弹框logoURL
	 **/
	public $logo;

	/**
	 * 口令弹框内容
	 **/
	public $text;

	/**
	 * 口令跳转目标页
	 **/
	public $url;

	/**
	 * 生成口令的淘宝用户ID
	 **/
	public $userId;

	public $apiParas = array();

	public function setExt($ext)
	{
		$this->ext = $ext;
		$this->apiParas["ext"] = $ext;
	}

	public function getExt()
	{
		return $this->ext;
	}

	public function setLogo($logo)
	{
		$this->logo = $logo;
		$this->apiParas["logo"] = $logo;
	}

	public function getLogo()
	{
		return $this->logo;
	}

	public function setText($text)
	{
		$this->text = $text;
		$this->apiParas["text"] = $text;
	}

	public function getText()
	{
		return $this->text;
	}

	public function setUrl($url)
	{
		$this->url = $url;
		$this->apiParas["url"] = $url;
	}

	public function getUrl()
	{
		return $this->url;
	}

	public function setUserId($userId)
	{
		$this->userId = $userId;
		$this->apiParas["user_id"] = $userId;
	}

	public function getUserId()
	{
		return $this->userId;
	}

	public function getApiMethodName()
	{
		return "taobao.tbk.tpwd.create";
	}

	public function getApiParas()
	{
		return $this->apiParas;
	}

	public function check()
	{

		RequestCheckUtil::checkNotNull($this->text,"text");
		RequestCheckUtil::checkNotNull($this->url,"url");
	}

	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
