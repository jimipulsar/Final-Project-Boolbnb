<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	use Storage;
	
	class Image extends Model {
		
		protected $fillable = ['name', 'room_id', 'index'];
		
		/**
		 * Eloquent relationship
		 *
		 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
		 */
		public function rooms() {
			
			return $this->belongsTo(Room::class);
		}
		
		/**
		 * Store additionaly images for an apartment
		 *
		 * @param $room_id
		 * @param $other_images
		 */
		public static function storeAdditional($room_id, $other_images) {
			
			$lastIndexImage = self::select('index')->where('room_id', $room_id)->orderBy('index', 'desc')->get()->first();
			$i = $lastIndexImage ? $lastIndexImage->index + 1 : 1;
			foreach ($other_images as $other_image) {
				$name = self::storeFile($other_image);
				self::create(['room_id' => $room_id, 'name' => $name, 'index' => $i++]);
			}
			
		}
		
		/**
		 * Store an image on disk
		 *
		 * @param $image_file
		 * @return string
		 */
		public static function storeFile($image_file): string {
			
			$filePath = Storage::disk('users_uploads')->put('rooms', $image_file);
			return basename($filePath);
		}
		
		/**
		 * Remove the given image from the given apartment
		 *
		 * @param $room_id
		 * @param $image_index
		 */
		public static function removeFor($room_id, $image_index): void {
			
			self::where('room_id', $room_id)->where('index', $image_index)->delete();
		}
		
		/**
		 * Refactor indexes of given apartment images
		 *
		 * @param $room_id
		 */
		public static function refactorIndexes($room_id): void {
			
			$images = self::where('room_id', $room_id)->orderBy('index')->get();
			$i = 1;
			foreach ($images as $image) {
				$image->index = $i++;
				$image->save();
			}
		}
	}
