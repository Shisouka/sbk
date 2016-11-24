<?php
/**
 * Created by PhpStorm.
 * User: СергейБеляев
 * Date: 15.16.16
 * Time: 13:48
 */
// 15.06.16 старый thumbname от \yii\imagine\BaseImage почему-то перестал центрировать картинку и прижимал её к краю бокса. Пришлось написать хэлпер-наследник

namespace common\helpers;


use Imagine\Image\ManipulatorInterface;
use Imagine\Image\Point;

class image extends \yii\imagine\BaseImage
{
	public static function thumbnail($filename, $width, $height, $mode = ManipulatorInterface::THUMBNAIL_OUTBOUND)
	{
		$img = static::getImagine()->open(\Yii::getAlias($filename));

		$sourceBox = $img->getSize();
		$thumbnailBox = static::getThumbnailBox($sourceBox, $width, $height);

		if (($sourceBox->getWidth() <= $thumbnailBox->getWidth() && $sourceBox->getHeight() <= $thumbnailBox->getHeight()) || (!$thumbnailBox->getWidth() && !$thumbnailBox->getHeight())) {
			return $img->copy();
		}

		$img = $img->thumbnail($thumbnailBox, $mode);
		$color = null;
		// create empty image to preserve aspect ratio of thumbnail
		if (class_exists('Imagine\Image\Color')) { // old version BaseImage
			$color = new \Imagine\Image\Color(static::$thumbnailBackgroundColor, static::$thumbnailBackgroundAlpha);
		} elseif (class_exists('Imagine\Image\Palette\RGB')) { // new version BaseImage
			if ($mode == ManipulatorInterface::THUMBNAIL_OUTBOUND) {
				return $img;
			}

			$size = $img->getSize();

			if ($size->getWidth() == $width && $size->getHeight() == $height) {
				return $img;
			}
			$palette = new \Imagine\Image\Palette\RGB();
			$color = $palette->color(static::$thumbnailBackgroundColor, static::$thumbnailBackgroundAlpha);
		}
		$thumb = static::getImagine()->create($thumbnailBox, $color);

		// calculate points
		$startX = 0;
		$startY = 0;
		if ($sourceBox->getWidth() < $width) {
			$startX = ceil($width - $sourceBox->getWidth()) / 2;
		} elseif ($sourceBox->getWidth() > $width && $img->getSize()->getWidth() < $width) {
			$startX = ceil($width - $img->getSize()->getWidth()) / 2;
		}
		if ($sourceBox->getHeight() < $height) {
			$startY = ceil($height - $sourceBox->getHeight()) / 2;
		} elseif ($sourceBox->getHeight() > $height && $img->getSize()->getHeight() < $height) {
			$startY = ceil($height - $img->getSize()->getHeight()) / 2;
		}

		$thumb->paste($img, new Point($startX, $startY));

		return $thumb;
	}
}