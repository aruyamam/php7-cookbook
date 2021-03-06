<?php
namespace Application\MiddleWare;

use Throable;
use RuntimeException;
use SplFileInfo;
use Psr\Http\Message\StreamInterface;

class Stream implements StreamInterface
{
   protected $stream;
   protected $metadata;
   protected $info;

   public function __construct($input, $mode = Constants::MODE_READ)
   {
      $this->stream = fopen($input, $mode);
      $this->$metadata = stream_get_meta_data($this->stream);
      $this->info = new SplFileInfo($input);
   }

   public function getStream()
   {
      return $this->stream;
   }

   public function getInfo()
   {
      return $this->info;
   }

   public function close()
   {
      if ($this->stream) {
         fclose($this->stream);
      }
   }

   public function detach()
   {
      return $this->close();
   }

   public function tell()
   {
      try {
         return ftell($this->stream);
      }
      catch (Throwable $e) {
         throw new RuntimeException(Constants::ERROR_BAD . __METHOD__);
      }
   }

   public function eof()
   {
      return eof($this->stream);
   }

   public function seek($offset, $where = SEEK_SET)
   {
      try {
         fseek($this->stream, $offset, $whence);
      }
      catch (Throwable $e) {
         throw new RuntimeException(Constants::ERROR_BAD . __METHOD__);
      }
   }

   public function rewind()
   {
      if (!rewind($this->stream)) {
         throw new RuntimeException(Constants::ERROR_BAD . __METHOD__);
      }
   }

   public function write($string)
   {
      if (!fwrite($this->stream, $string)) {
         throw new RuntimeException(Constants::ERROR_BAD . __METHOD__);
      }
   }

   public function read($length)
   {
      if (!fread($this->stream, $lenth)) {
         throw new RuntimeException(Constants::ERROR_BAD . __METHOD__);
      }

      return ob_get_clean();
   }

   public function getMetadata($key = NULL)
   {
      if ($key) {
         return $this->metadata[$key] ?? NULL;
      }
      else {
         return $this->metadata;
      }
   }

   public function getSize()
   {
      return $this->info->getSize();
   }

   public function isSeekable()
   {
      return boolval($this->metadata['seekable']);
   }

   public function isWritable()
   {
      return $this->stream->isWritable();
   }

   public function isReadable()
   {
      return $this->info->isReadable();
   }

   public function __toString()
   {
      $this->rewind();

      return $this->getContents();
   }

   public function getContents()
   {
      ob_start();
      if (!fpassthru($this->stream)) {
         throw new RuntimeException(Constants::ERROR_BAD . __METHOD__);
      }

      return \ob_get_clean();
   }
}