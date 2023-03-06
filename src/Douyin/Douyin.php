<?php
namespace Vqh\Socialvideos\Douyin;
use Vqh\Socialvideos\CURL;

class Douyin
{
    private $headers=['cookie: douyin.com; s_v_web_id=verify_la7udy4g_4IJtmDpB_v6m8_4L0B_Bsm6_JAEMoLsxhKys; passport_csrf_token=186b7bcfd87f579c60a67d35f19fe9c1; passport_csrf_token_default=186b7bcfd87f579c60a67d35f19fe9c1; csrf_session_id=4f9475d4dbe24d70951c1ada6262a645; n_mh=WZp_FTaGhpNn8yHatnPpROsyat9W3gqOXXseck3zZew; passport_assist_user=CkGpXg5PjkXenQdbIfAgyoZnxyLMvFdP9N558Zx5Nak4vHJQmG27Tw9zZGbXr7VwzxaofcX1d7h6vGroV0fCIEa3yRpICjwBAfTlznkiNfqFj7y2NZ7yGaxIfiKBrB1YZCC1s_o4FmDJGO0VHqijEoigOJmrSbL55xijP2-5wFcx-vgQgvqgDRiJr9ZUIgEDWoDktQ%3D%3D; sso_uid_tt=11a6396bb5f53d6368b87fb650c85097; sso_uid_tt_ss=11a6396bb5f53d6368b87fb650c85097; toutiao_sso_user=6b166f85e829446968ce4fe951c6382b; toutiao_sso_user_ss=6b166f85e829446968ce4fe951c6382b; sid_ucp_sso_v1=1.0.0-KGNhZjYwNTY2NmI0MWQ5ZGVkNzI4YWExYTNlMGE4NDVjNmU1ZjUwMmUKHwjN8OCa7o39BRDyprmbBhjvMSAMMJbsuJcGOAZA9AcaAmxmIiA2YjE2NmY4NWU4Mjk0NDY5NjhjZTRmZTk1MWM2MzgyYg; ssid_ucp_sso_v1=1.0.0-KGNhZjYwNTY2NmI0MWQ5ZGVkNzI4YWExYTNlMGE4NDVjNmU1ZjUwMmUKHwjN8OCa7o39BRDyprmbBhjvMSAMMJbsuJcGOAZA9AcaAmxmIiA2YjE2NmY4NWU4Mjk0NDY5NjhjZTRmZTk1MWM2MzgyYg; passport_auth_status=040a2071608b8cf84c84b159c68dcd13%2Cd3437ad9218fc0a4fdaf64f3ae07cea9; passport_auth_status_ss=040a2071608b8cf84c84b159c68dcd13%2Cd3437ad9218fc0a4fdaf64f3ae07cea9; sid_guard=0e9c88492704dba9770c668cfb3ad65d%7C1668174708%7C5183998%7CTue%2C+10-Jan-2023+13%3A51%3A46+GMT; uid_tt=e3bf5c655838577b69114b35d1fc1835; uid_tt_ss=e3bf5c655838577b69114b35d1fc1835; sid_tt=0e9c88492704dba9770c668cfb3ad65d; sessionid=0e9c88492704dba9770c668cfb3ad65d; sessionid_ss=0e9c88492704dba9770c668cfb3ad65d; sid_ucp_v1=1.0.0-KDZiZDgxN2Q0YTc4NzZhY2ZhN2Y1OTMzMDQ2MjU5MmYyYzE0Yjc5NjEKGQjN8OCa7o39BRD0prmbBhjvMSAMOAZA9AcaAmhsIiAwZTljODg0OTI3MDRkYmE5NzcwYzY2OGNmYjNhZDY1ZA; ssid_ucp_v1=1.0.0-KDZiZDgxN2Q0YTc4NzZhY2ZhN2Y1OTMzMDQ2MjU5MmYyYzE0Yjc5NjEKGQjN8OCa7o39BRD0prmbBhjvMSAMOAZA9AcaAmhsIiAwZTljODg0OTI3MDRkYmE5NzcwYzY2OGNmYjNhZDY1ZA; ttwid=1%7CZJz8d7FMqSJauHQkZnXbfmEtX7U7VowfL4lrIHwxIrE%7C1669004154%7C1107c4182cf17778481cd718ed28fb50f32ef9d098167791279861fe527ee897; __ac_nonce=0637c2160001170e5b63a; __ac_signature=_02B4Z6wo00f01V9PI7AAAIDA1AS4U-D7XYVfbycAADSzKczKBkyLvUAJNT6gj4DHSBXo3JZ5DGKB3F2LjzMBzivdhNTUAWMwnPtZsqawVprpEIRbHLmyEM-dJB1PI1V6UatVyuQfUM-HZZ2wd3; FOLLOW_NUMBER_YELLOW_POINT_INFO=%22MS4wLjABAAAAlQ5yVlHkiaeoD0B0cS8JhPr3Rxq5X_L0rDXxt7DzRz13Mi6zuxv-Ig7cdtGdafPu%2F1669132800000%2F0%2F1669079409144%2F0%22; odin_tt=f7aa3135bb330c04a7d48dabecf474e0f2b15128c53fddb3ffbe4dc6098c583f2fb44d4dc8585abfaf0e9e18e0166bad; download_guide=%223%2F20221122%22; SEARCH_RESULT_LIST_TYPE=%22single%22; strategyABtestKey=%221669079772.107%22; msToken=G0-VTpRTq_f0OfV55_jAA5SMdpLeJy2zaB9NTjYB9SaSBRZfuNgcJ24UvdlIhKbb0ZN_f3YPxNcDfnShM4DI2unCBrPSycENSffVdHSphvcbqmxvZpwxLw==; msToken=Tj_LIlFpENGTrN5F0qzmbEe_bKv9OehazbEF4OEiRR_JKzAwNME_ZcsPzpI4CYqnVtzQppea9wjeYwhFNLtF4Xq3YliI2fliX_lxrtMu1K8AwXW_WWOfCA==; tt_scid=XdZaOsCXffhbGXRHfYqV3ZH7u538K.HV-IMI4C1koLPSjUCKCdu2QvefnvhkeFEL64f5; home_can_add_dy_2_desktop=%220%22'];
    public function setHeaders($headers=[])
    {
        $this->headers=$headers;
        return $this;
    }
    public function getVideoInfo($url){
        $request=CURL::GET($url,$this->headers,[CURLOPT_FOLLOWLOCATION=>true,CURLOPT_HEADER=>true]);
        if ($request->code===200&&!$request->error)
        {
            $dataContent=null;
            preg_match('/video\/(\d+)/',urldecode($request->endURL),$matchesheaders);
            preg_match('/data-e2e-aweme-id="(\d+)"/',urldecode($request->data),$matches);
            if (isset($matchesheaders[1])&&!empty($matchesheaders[1]))
            {
                $id = trim($matchesheaders[1]);
                $dataContent=urldecode(CURL::GET("https://www.douyin.com/video/{$id}",$this->headers)->data);

            }elseif (isset($matches[1])&&!empty($matches[1]))
            {
                $dataContent=urldecode($request->data);
            }
            if (empty($dataContent))
            {
                return false;
            }
            preg_match('/type="application\/json">(.*?)<\/script>/i',$dataContent,$datajson);
            if (!isset($datajson[1]))
            {
                return false;
            }
            $json=json_decode($datajson[1],true);
            $json=$json['44']['aweme']['detail'];
            return [
                'nickname'=>$json['authorInfo']['nickname'],
                'secUid'=>$json['authorInfo']['secUid'],
                'author_avatar'=>$json['authorInfo']['avatarUri'],
                'music'=>$json['music']['playUrl']['uri'],
                'video'=>$json['video']['playApi'],
                'video_desc'=>$json['desc'],
                'comment_count'=>$json['stats']['commentCount'],
                'play_count'=>$json['stats']['playCount'],
                'share_count'=>$json['stats']['shareCount'],
                'digg_count'=>$json['stats']['diggCount'],
            ];
        }
        return false;
    }

    public function search($keyword,$offset=0)
    {
        $url="https://www.douyin.com/aweme/v1/web/general/search/single/?device_platform=webapp&aid=6383&channel=channel_pc_web&search_channel=aweme_general&sort_type=0&publish_time=0&keyword=".urlencode($keyword)."&search_source=normal_search&query_correct_type=1&is_filter_search=0&from_group_id=&offset={$offset}&count=20&pc_client_type=1&version_code=190600&version_name=19.6.0&cookie_enabled=true&screen_width=1366&screen_height=768&browser_language=vi-VN&browser_platform=Win32&browser_name=Chrome&browser_version=110.0.0.0&browser_online=true&engine_name=Blink&engine_version=110.0.0.0&os_name=Windows&os_version=10&cpu_core_num=4&device_memory=8&platform=PC&downlink=10&effective_type=4g&round_trip_time=100&webid=7203248605887661608&msToken=&X-Bogus=";
        $head=['referer: https://www.douyin.com/search/'];
        $head=array_merge($head,$this->headers);
        $curl=CURL::GET($url,$head);
        if ($curl->code===200&&!$curl->error)
        {
            $all=[];
            $json=json_decode($curl->data,true);
            foreach ($json['data'] as $datum)
            {
                if (!isset($datum['aweme_info'])||!isset($datum['aweme_info']['video']['cover']['url_list'][0]))
                {
                    continue;
                }
                $all[]=[
                    'id'=>$datum['aweme_info']['aweme_id'],
                    'desc'=>isset($datum['aweme_info']['desc'])?$datum['aweme_info']['desc']:'',
                    'cover'=>isset($datum['aweme_info']['video']['cover']['url_list'][0])?$datum['aweme_info']['video']['cover']['url_list'][0]:'',
                    'author'=>[
                        'nickname'=>$datum['aweme_info']['author']['nickname'],
                        'secUid'=>$datum['aweme_info']['author']['sec_uid'],
                        'avatar'=>$datum['aweme_info']['author']['avatar_medium']['url_list'][0],
                        'desc'=>isset($datum['aweme_info']['author']['signature'])?$datum['aweme_info']['author']['signature']:'',
                    ]
                ];
            }
            return $all;
        }
        return false;
    }
}