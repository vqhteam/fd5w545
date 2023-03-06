<?php
namespace Vqh\Socialvideos\Tiktok;
use Vqh\Socialvideos\CURL;

class TikTok
{
    private $headers=[];
    public function setHeaders($headers=[])
    {
        $this->headers=$headers;
        return $this;
    }
    public function getVideoId($url){
        $request=CURL::GET($url,$this->headers,[CURLOPT_FOLLOWLOCATION=>true]);
        if ($request->code===200&&!$request->error)
        {
            preg_match('/"keyword":"(\d+)"/',urldecode($request->data),$matches);
            if (isset($matches[1])&&!empty($matches[1]))
            {
                return trim($matches[1]);
            }
        }
        return null;
    }
    public function getVideoInfo($videoId){
        $url = "https://api-h2.tiktokv.com/aweme/v1/feed/?aweme_id={$videoId}&version_name=26.1.3&version_code=2613&build_number=26.1.3&manifest_version_code=2613&update_version_code=2613&{openudid}=6273a5108e49dfcb&uuid={uuid}&_rticket=1667123410000&ts={ts}&device_brand=Google&device_type=Pixel%204&device_platform=android&resolution=1080*1920&dpi=420&os_version=10&os_api=29&carrier_region=US&sys_region=US%C2%AEion=US&app_name=trill&app_language=en&language=en&timezone_name=America/New_York&timezone_offset=-14400&channel=googleplay&ac=wifi&mcc_mnc=310260&is_my_cn=0&aid=1180&ssmix=a&as=a1qwert123&cp=cbfhckdckkde1";
        $curl=CURL::GET($url,$this->headers);
        if ($curl->code===200&&!$curl->error)
        {
            $json=json_decode($curl->data,true);
            $nickname=$json['aweme_list'][0]['author']['nickname'];
            $username=$json['aweme_list'][0]['author']['unique_id'];
            $author_avatar=$json['aweme_list'][0]['author']['avatar_medium']['url_list'][0];
            $music=$json['aweme_list'][0]['music']['play_url']['url_list'][0];
            $video=$json['aweme_list'][0]['video']['play_addr']['url_list'][0];
            $video_desc=$json['aweme_list'][0]['desc'];
            $comment_count=$json['aweme_list'][0]['statistics']['comment_count'];
            $play_count=$json['aweme_list'][0]['statistics']['play_count'];
            $share_count=$json['aweme_list'][0]['statistics']['share_count'];
            $digg_count=$json['aweme_list'][0]['statistics']['digg_count'];
            return [
                'nickname'=>$nickname,
                'username'=>$username,
                'author_avatar'=>$author_avatar,
                'music'=>$music,
                'video'=>$video,
                'video_desc'=>$video_desc,
                'comment_count'=>$comment_count,
                'play_count'=>$play_count,
                'share_count'=>$share_count,
                'digg_count'=>$digg_count
            ];
        }
        return false;
    }
    public function search($keyword,$offset=0)
    {
        $url="https://www.tiktok.com/api/search/general/full/?aid=1988&app_language=zh-Hant-TW&app_name=tiktok_web&battery_info=1&browser_language=zh-CN&browser_name=Mozilla&browser_online=true&browser_platform=MacIntel&browser_version=5.0%20%28Macintosh%3B%20Intel%20Mac%20OS%20X%2010_15_7%29%20AppleWebKit%2F537.36%20%28KHTML%2C%20like%20Gecko%29%20Chrome%2F107.0.0.0%20Safari%2F537.36&channel=tiktok_web&cookie_enabled=true&device_id=7173961358269646337&device_platform=web_pc&focus_state=true&from_page=search&history_len=3&is_fullscreen=false&is_page_visible=true&keyword=".urlencode($keyword)."&offset={$offset}&os=mac&priority_region=&referer=&region=SG&screen_height=1080&screen_width=1920&tz_name=Asia%2FShanghai&webcast_language=zh-Hant-TW&msToken=W7IagJhZQ5xWYCBfr5njBqLgccZISpTbf-BVQLkvYwdpWD7uZgApaAQCwQwctB-T0zaG06A20anq07vAKTsL_dVlueFmCbMkyzFcfLLI03K_Wcpb-0vupyisglLCAYb4w_VeujeWflqCY0pK&X-Bogus=DFSzswVLqg2ANcoQSpF8c37TlqCg&_signature=_02B4Z6wo000019RUk9QAAIDAQILI2MoFNjvUVJdAAJajfa";
        $curl=CURL::GET($url,['cookie:tt_csrf_token=WNzIcoNY-wy-KNgVoJo8ZB6QOtKXC4geDlTg; tt_chain_token=GMqzqYdmMbJpHaBk+UUhdg==; tiktok_webapp_theme=light; __tea_cache_tokens_1988={%22_type_%22:%22default%22%2C%22user_unique_id%22:%227173961358269646337%22%2C%22timestamp%22:1670318057596}; ak_bmsc=349C7752F2AF3CA03207ACD28780895F~000000000000000000000000000000~YAAQNqs0F6skEcGEAQAAauy25hKJiwq0j+AmaMvqK4UhvuHZf/Qt1ZaUvt5Lq9Ylo/fWJgA38filVbgwbXtuGJZNfwYFvYJpJ7IzEs36g3iVcPjh092Lr1zi49vcGxK/vOuHexRz9GCLLZhdBGPrdPpCKX6xg3UlI9UWR9SUtcxkRdkV8RSmcAlwtV+E5ZxPcU34UQHG3lFF93ohbfiKNJdYFxbBc/5zeHoJJyd8LnD17gGK48NPZ1qe62zrzzUK+OCRpxRpUMcO3KJn1T4j8Qj1R/yrdgxbvSA9UKjbwIPTZAxPh4ZrTyAts2jtNMIHSmE80qcuu1DtYqw58T/sKhfao3D17nGE61cFZvqo9K1f1YOE7M6TL7RqPagf1V+umGBECsP0X4qk6KXyek0jpO0280Dr0LLWA3oYGN35FvKOekyceCYs2o7sjYTG+4egv9FeM7ApX6ZJBKrftqP0Y34cIthL0uGYdmE1ZlSfW7LpgxigLfQB2kaXCQ==; ttwid=1%7CxI0mD1Yz4JYzTm5ugF7WCxZFsftzyIM9NW_GgVrzFxE%7C1670318190%7C087ebd1daa4f59fcff0039f30f19ced6d3a7018e3ecfbb30ada6831fba31f14f; bm_sv=51043CEE1C16967790C085A953E05E8C~YAAQNqs0FykyEcGEAQAAbfm45hLDLQHnodg5JkSEf1KgH0H2+EveNMrtxZL5sq1NGJO2Q30bDTnj0UlKR1VIpUpLPkftu59oJqvNXAwK5CbcYT5fP0pRuzbsMpLzZ/TbhLNm1kvTacffgNlPrZgyCi0rIVE8TSIRLmmMVwQfR4NI586WIj5SzMLvJbZAJ+1SyfHjYNnBhRogmwfIWdDuyg0Q971BGUuEUDXVsymlqicce0U9GFQkl0LQBXj72ooD~1; msToken=SmWcr1TVdM7tLMF9yNkebFZY-FsZp1PghjiccBgDURLxz8qcluFQ1bWhWfocrCB6s9-k5gnhCzgd-9fxVQyVsApvI4D_13Xf5u8OGD-FTY_m-V0Y5j9PxOQcPKiUw6U=; msToken=W7IagJhZQ5xWYCBfr5njBqLgccZISpTbf-BVQLkvYwdpWD7uZgApaAQCwQwctB-T0zaG06A20anq07vAKTsL_dVlueFmCbMkyzFcfLLI03K_Wcpb-0vupyisglLCAYb4w_VeujeWflqCY0pK']);
        if ($curl->code===200&&!$curl->error)
        {
            $all=[];
            $json=json_decode($curl->data,true);
            foreach ($json['data'] as $datum)
            {
                if (!isset($datum['item']))
                {
                    continue;
                }
                $all[]=[
                    'id'=>$datum['item']['id'],
                    'desc'=>$datum['item']['desc'],
                    'cover'=>$datum['item']['video']['cover'],
                    'author'=>[
                        'nickname'=>$datum['item']['author']['nickname'],
                        'username'=>$datum['item']['author']['uniqueId'],
                        'avatar'=>$datum['item']['author']['avatarMedium'],
                        'desc'=>$datum['item']['author']['signature'],
                    ]
                ];
            }
            return $all;
        }
        return false;
    }
}