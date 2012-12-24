<?php

class AwsUploader
{
	protected static $s3 = null;

	protected static $_aws_url = 'http://s3.amazonaws.com/';

	protected static function s3()
	{
		if(static::$s3 === null)
		{
			static::$s3 = new S3(Config::get('s3.aws-access'), Config::get('s3.aws-secret'));
		}
		
		return static::$s3;
	}

	public static function aws_url()
	{
		return static::$_aws_url;
	}

	public static function upload_to($container, $file, $name = null, $unlink = true)
	{
		if($container === null)
		{
			throw new Exception('You Gotta name a container');
		}

		if($file === null)
		{
			throw new Exception('you gotta have a file to upload');
		}

		if($name === null) {
			$arr = explode(DS, $file);
			$name = end($arr);
		}
	
		$ext = File::extension($name);

		static::s3()->putBucket($container, S3::ACL_PUBLIC_READ);

		if( static::s3()->putObject(file_get_contents($file), $container, $name, S3::ACL_PUBLIC_READ, array(), array('Content-Type'=>File::mime($ext))) )
		{
			if($unlink === true)
				unlink($file);

			return static::aws_url() . $container . '/' . $name;
		}
		else
		{
			throw new Exception('error uploading file');
		}
	}
}
