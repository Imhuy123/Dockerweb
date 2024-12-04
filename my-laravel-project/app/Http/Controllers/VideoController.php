<?php

namespace App\Http\Controllers;

use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
use Illuminate\Http\Request;
use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;

class VideoController extends Controller
{
    /**
     * Chuyển video sang định dạng HLS (HTTP Live Streaming).
     */
    public function convertVideo()
    {
        $filepath = public_path('/video/testvideo.mp4'); // Đường dẫn video đầu vào
        $outputDir = public_path('/video/output/hls'); // Thư mục chứa các file HLS

        // Đảm bảo thư mục output tồn tại
        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0777, true);
        }

        // Đường dẫn file playlist .m3u8 và các segment video
        $outputPlaylist = $outputDir . '/playlist.m3u8';
        $outputSegment = $outputDir . '/segment_%03d.ts'; // Các file video segment (.ts)

        // Lệnh FFmpeg để tạo HLS
        $command = "ffmpeg -i $filepath -profile:v baseline -level 3.0 -start_number 0 -hls_time 10 -hls_list_size 0 -f hls $outputPlaylist";

        // Thực thi lệnh FFmpeg
        exec($command, $output, $returnVar);

        // Kiểm tra kết quả thực thi lệnh
        if ($returnVar === 0) {
            return response()->json(['message' => 'Video đã được chuyển đổi thành công sang HLS.']);
        } else {
            return response()->json(['message' => 'Có lỗi khi chuyển đổi video.'], 500);
        }
    }
}
