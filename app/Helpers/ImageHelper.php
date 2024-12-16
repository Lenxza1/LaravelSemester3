<?php
namespace App\Helpers;
class ImageHelper
{
    public static function uploadAndResize(
        $file,
        $directory,
        $fileName,
        $width = null,
        $height = null
    ) {
        try {
            if (!$file) {
            throw new \Exception('No file was uploaded');
            }

            $destinationPath = public_path($directory);
            if (!file_exists($destinationPath)) {
            if (!mkdir($destinationPath, 0777, true)) {
                throw new \Exception('Failed to create directory');
            }
            }

            $extension = strtolower($file->getClientOriginalExtension());
            if (!in_array($extension, ['jpeg', 'jpg', 'png', 'gif'])) {
            throw new \Exception('Invalid file type. Only JPEG, PNG and GIF are allowed');
            }

            $image = null;

            switch ($extension) {
            case 'jpeg':
            case 'jpg':
                $image = @imagecreatefromjpeg($file->getRealPath());
                break;
            case 'png':
                $image = @imagecreatefrompng($file->getRealPath());
                break;
            case 'gif':
                $image = @imagecreatefromgif($file->getRealPath());
                break;
            default:
                throw new \Exception('Unsupported image type');
            }

            if (!$image) {
            throw new \Exception('Failed to create image resource');
            }

            if ($width) {
            $oldWidth = imagesx($image);
            $oldHeight = imagesy($image);
            $aspectRatio = $oldWidth / $oldHeight;
            if (!$height) {
                $height = $width / $aspectRatio; 
            }
            $newImage = imagecreatetruecolor($width, $height);
            if (!$newImage) {
                throw new \Exception('Failed to create resized image');
            }
            
            if (!imagecopyresampled(
                $newImage,
                $image,
                0,
                0,
                0,
                0,
                $width,
                $height,
                $oldWidth,
                $oldHeight
            )) {
                throw new \Exception('Failed to resize image');
            }
            
            imagedestroy($image);
            $image = $newImage;
            }

            $success = false;
            switch ($extension) {
            case 'jpeg':
            case 'jpg':
                $success = imagejpeg($image, $destinationPath . '/' . $fileName);
                break;
            case 'png':
                $success = imagepng($image, $destinationPath . '/' . $fileName);
                break;
            case 'gif':
                $success = imagegif($image, $destinationPath . '/' . $fileName);
                break;
            }

            imagedestroy($image);

            if (!$success) {
            throw new \Exception('Failed to save image');
            }

            return $fileName;

        } catch (\Exception $e) {
            if (isset($image) && is_resource($image)) {
            imagedestroy($image);
            }
            throw $e;
        }
    }
}