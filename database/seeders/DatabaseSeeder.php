<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Channel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@aimbot.tv'],
            [
                'name' => 'Aimbot Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // Standard User
        User::updateOrCreate(
            ['email' => 'user@aimbot.tv'],
            [
                'name' => 'John Doe',
                'password' => Hash::make('user123'),
                'role' => 'user',
            ]
        );

        // Complete user-requested channel list
        $channels = [
            [
                "name" => "BEIN Sports 5",
                "logo_url" => "https://carboncredits.com/wp-content/uploads/2025/09/shutterstock_2306088965-e1757112807302.jpg",
                "group" => "BeIN",
                "stream_url" => "https://starhub.pro/live/farhat-3379/67897-913379/744527.ts",
                "type" => "hls",
                "drm_kid" => null,
                "drm_key" => null
            ],
            [
                "name" => "BeIN MAX 1",
                "logo_url" => "https://images.fotmob.com/image_resources/logo/teamlogo/6720.png",
                "group" => "BeIN",
                "stream_url" => "https://tmaxapp.site/beinmax1.m3u8",
                "type" => "hls",
                "drm_kid" => null,
                "drm_key" => null
            ],
            [
                "name" => "BeIN MAX 2",
                "logo_url" => "https://images.fotmob.com/image_resources/logo/teamlogo/6719.png",
                "group" => "BeIN",
                "stream_url" => "https://tmaxapp.site/beinmax2.m3u8",
                "type" => "hls",
                "drm_kid" => null,
                "drm_key" => null
            ],
            [
                "name" => "BeIN MAX SD",
                "logo_url" => "https://images.fotmob.com/image_resources/logo/teamlogo/8570.png",
                "group" => "BeIN",
                "stream_url" => "https://prod-fastly-eu-west-1.video.pscp.tv/Transcoding/v1/hls/dpXv_Bj52CxsfzkpeY2HfAG9GNFBl7qI6s8HSUWcyRO-cjXHZqH9jkGzhEIgwNcw6R5ZRRUbA8ZV7S0DXKMrkQ/non_transcode/eu-west-1/periscope-replay-direct-prod-eu-west-1-public/master_dynamic_delta.m3u8?type=live",
                "type" => "hls",
                "drm_kid" => null,
                "drm_key" => null
            ],
            [
                "name" => "BeIN Sports 1",
                "logo_url" => "https://elmarada.org/wp-content/uploads/2022/03/download-247x200.png",
                "group" => "BeIN",
                "stream_url" => "https://41.205.70.146/BEINSPORT1/index.m3u8",
                "type" => "hls",
                "drm_kid" => null,
                "drm_key" => null
            ],
            [
                "name" => "BeIN Sports 2",
                "logo_url" => "https://elmarada.org/wp-content/uploads/2022/03/download-247x200.png",
                "group" => "BeIN",
                "stream_url" => "https://41.205.70.146/BEINSPORT2/index.m3u8",
                "type" => "hls",
                "drm_kid" => null,
                "drm_key" => null
            ],
            [
                "name" => "BeIN Sports 5",
                "logo_url" => "https://elmarada.org/wp-content/uploads/2022/03/download-247x200.png",
                "group" => "BeIN",
                "stream_url" => "https://41.205.70.146/BEINSPORT5/index.m3u8",
                "type" => "hls",
                "drm_kid" => null,
                "drm_key" => null
            ],
            [
                "name" => "Bein Sports 1 (Alt)",
                "logo_url" => "https://i.ibb.co.com/S7tZS6cg/Bein-Sports-1-Direct.png",
                "group" => "BeIN",
                "stream_url" => "https://1nyaler.streamhostingcdn.top/stream/23/index.m3u8",
                "type" => "hls",
                "drm_kid" => null,
                "drm_key" => null
            ],
            [
                "name" => "D SPORTS",
                "logo_url" => "https://images.fotmob.com/image_resources/logo/teamlogo/8570.png",
                "group" => "D Sports",
                "stream_url" => "https://otte.cache.aiv-cdn.net/bom-nitro/live/clients/dash/enc/3gg2jnixjn/out/v1/e1840e01f3f14563b66bbb944d5cc54c/cenc.mpd",
                "type" => "dash",
                "drm_kid" => "f8b207c10f3f76aeba32a360ec52b9e4",
                "drm_key" => "afad49d20eb39670e93e371c1d669921"
            ],
            [
                "name" => "D SPORTS FHD +",
                "logo_url" => "https://images.fotmob.com/image_resources/logo/teamlogo/8570.png",
                "group" => "D Sports",
                "stream_url" => "https://otte.live.fly.ww.aiv-cdn.net/gru-nitro/live/clients/dash/enc/ud6bnhthpj/out/v1/2639a2f4480f4269953de466d5f46463/cenc.mpd",
                "type" => "dash",
                "drm_kid" => "83f81c4cc1443991543de4e22eea7586",
                "drm_key" => "ddfd7ca653d6f35543d8edb3c688e20f"
            ],
            [
                "name" => "D Sports (Alt)",
                "logo_url" => "https://images.seeklogo.com/logo-png/62/1/dsports-logo-png_seeklogo-626310.png",
                "group" => "D Sports",
                "stream_url" => "https://otte.live.fly.ww.aiv-cdn.net/lhr-nitro/live/dash/enc/rgilyeubta/out/v1/09a67027b18f4fd78aaa3794a2aacfe8/cenc.mpd",
                "type" => "dash",
                "drm_kid" => "03f12d6a3dbfd3a6fa7dd7f6417e0c11",
                "drm_key" => "ea07b87acdf2e45be824cde4a1cf3504"
            ],
            [
                "name" => "D Sports 2",
                "logo_url" => "https://pbs.twimg.com/profile_images/1606267731682238464/oOV7mhc6_400x400.jpg",
                "group" => "D Sports",
                "stream_url" => "https://nog-live-ott.izzigo.tv/out/u/dash/CDMX1/CANAL-5-RDF-HD/default.mpd",
                "type" => "dash",
                "drm_kid" => "2a8c2d5088377f51f825d871e568be19",
                "drm_key" => "eb5a8db64ca1992389672edb9447c711"
            ],
            [
                "name" => "FOX 1080p [No VPN]",
                "logo_url" => "https://cdn.broadbandtvnews.com/wp-content/uploads/2025/05/13115423/Fox-One-Logo.jpg",
                "group" => "FOX",
                "stream_url" => "https://otte.cache.aiv-cdn.net/bom-nitro/live/clients/dash/enc/ajfoeddkbz/out/v1/b78800b9b2304879b15843f455836829/cenc.mpd",
                "type" => "dash",
                "drm_kid" => "f6564ec2aee819046328a0e153be574d",
                "drm_key" => "ff46a8a1031eb27ef22576a077c98ab7"
            ],
            [
                "name" => "FOX 4K [No VPN]",
                "logo_url" => "https://upload.wikimedia.org/wikipedia/commons/thumb/c/c0/Fox_Broadcasting_Company_logo_%282019%29.svg/250px-Fox_Broadcasting_Company_logo_%282019%29.svg.png",
                "group" => "FOX",
                "stream_url" => "https://otte.cache.aiv-cdn.net/iad-nitro/live/clients/enc/7ruw77zpm1/out/v1/31d30c91fc65458789b84209d3fa22e4/cenc.mpd",
                "type" => "dash",
                "drm_kid" => "1f68713028d439ec03be07f56c1d6213",
                "drm_key" => "20093db6455160fffed4c394def3193d"
            ],
            [
                "name" => "FS1 [No VPN]",
                "logo_url" => "https://cdn.broadbandtvnews.com/wp-content/uploads/2025/05/13115423/Fox-One-Logo.jpg",
                "group" => "FOX",
                "stream_url" => "https://vizio.kuvuslov.cymru/fs1/tracks-v1a1/mono.m3u8",
                "type" => "hls",
                "drm_kid" => null,
                "drm_key" => null
            ],
            [
                "name" => "FIFA +",
                "logo_url" => "https://roams.es/images/post/es_ES_news/categoria-telefonia/1200x675/logo-de-fifa-plus.webp",
                "group" => "FOX",
                "stream_url" => "https://e3be9ac5.wurl.com/manifest/f36d25e7e52f1ba8d7e56eb859c636563214f541/TEctYnJfRklGQVBsdXNQb3J0dWd1ZXNlX0hMUw/9c1dd781-4ee3-4668-a957-fa1e6f81d613/3.m3u8",
                "type" => "hls",
                "drm_kid" => null,
                "drm_key" => null
            ],
            [
                "name" => "LIVE 1",
                "logo_url" => "https://cdn.sportmonks.com/images/cricket/teams/8/72.png",
                "group" => "Live",
                "stream_url" => "https://otte.cache.aiv-cdn.net/bom-nitro/live/clients/dash/enc/tll6uwepxa/out/v1/a7f67cbb33df46539312956427343886/cenc.mpd",
                "type" => "dash",
                "drm_kid" => "290e09c837da78d5cd961978d390515c",
                "drm_key" => "b748836c71e6a4ca68ef5b5652db6247"
            ],
            [
                "name" => "SERVER 1",
                "logo_url" => "https://images.fotmob.com/image_resources/logo/teamlogo/8263.png",
                "group" => "Server",
                "stream_url" => "https://live.wxinxi.com/live/25816724_sb2maw7iluj1ghr92sk5siud28tpimx0.m3u8",
                "type" => "hls",
                "drm_kid" => null,
                "drm_key" => null
            ],
            [
                "name" => "SERVER 3",
                "logo_url" => "https://images.fotmob.com/image_resources/logo/teamlogo/8263.png",
                "group" => "Server",
                "stream_url" => "https://193.47.62.55/hls/Xlplplpqqq.m3u8",
                "type" => "hls",
                "drm_kid" => null,
                "drm_key" => null
            ],
            [
                "name" => "SKY SPORTS HD [No VPN]",
                "logo_url" => "https://cdn.sportmonks.com/images/cricket/teams/6/38.png",
                "group" => "Sky Sports",
                "stream_url" => "https://bl.rutube.ru/livestream/7c13a51576b9ff2601f08f5d57dd5169/index.m3u8?s=uiXES2ePt7xTpQnbJxn7Dg&e=2074684474&scheme=https",
                "type" => "hls",
                "drm_kid" => null,
                "drm_key" => null
            ],
            [
                "name" => "Sky Sports La Liga",
                "logo_url" => "https://epg.pw/media/images/epg/2025/04/23/20250423022300132210_61.png",
                "group" => "Sky Sports",
                "stream_url" => "https://aca-live4-ott.izzigo.tv/12/out/u/dash/SKY-SPORTS-16-HD/default.mpd",
                "type" => "dash",
                "drm_kid" => "cb80e1e7d7598eaf98b1dbbe6dc14ee9",
                "drm_key" => "103ae55c7948ca1d159d6743619d26c4"
            ],
            [
                "name" => "Sky Sports La Liga 1",
                "logo_url" => "https://epg.pw/media/images/epg/2025/04/23/20250423022300132210_61.png",
                "group" => "Sky Sports",
                "stream_url" => "https://aca-live-ott.izzigo.tv/7/out/u/dash/SKY-SPORTS-16-HD-H265/default.mpd",
                "type" => "dash",
                "drm_kid" => "95b52d16d344af539ce9c2c9ff95571a",
                "drm_key" => "5f035d9c4a178221f89d2439426b2e9a"
            ],
            [
                "name" => "SporTV 3",
                "logo_url" => "https://images.seeklogo.com/logo-png/42/2/sportv-logo-png_seeklogo-424355.png",
                "group" => "Sport TV",
                "stream_url" => "https://otte.cache.aiv-cdn.net/gru-nitro/live/clients/dash/enc/6otiglnptp/out/v1/add7499679b0422cb6791f7701f95ecc/cenc.mpd",
                "type" => "dash",
                "drm_kid" => "902e5ec0e3d05e665daa32fc23f4f59e",
                "drm_key" => "7b2322a273843921a43e2c61dac7cae3"
            ],
            [
                "name" => "TNT",
                "logo_url" => "https://resources.motogp.pulselive.com/photo-resources/2026/06/15/4b8f1a01-10ce-4c91-8c14-b906d9f77caf/Czechia-GP-Poster.jpg?height=192&width=343",
                "group" => "TNT Sports",
                "stream_url" => "https://otte-qw.live.pv-cdn.net/fra-nitro/live/clients/dash/enc/3j04z3pbit/out/v1/042ee0757ed348bf8c26f75895cae871/cenc.mpd",
                "type" => "dash",
                "drm_kid" => "0b59ce06de74ed84f2eda5e81dadba13",
                "drm_key" => "48e4ba4ad6c2a60d2bda5d71a0050844"
            ],
            [
                "name" => "TNT SPORTS",
                "logo_url" => "https://cdn.sportmonks.com/images/cricket/teams/5/37.png",
                "group" => "TNT Sports",
                "stream_url" => "https://otte.live.fly.ww.aiv-cdn.net/iad-nitro/live/clients/dash/enc/65ldy4ejuu/out/v1/69bc6b64f1c14e36bb21e0075a71d8ca/cenc.mpd",
                "type" => "dash",
                "drm_kid" => "570c19f1be3410e4e409be4dc7923f2b",
                "drm_key" => "9a4dea8af2a2a703dffa8a477e9edc50"
            ],
            [
                "name" => "TNT Sports 3",
                "logo_url" => "https://www.pitch.co.uk/wp-content/uploads/2023/12/TNT-Sports-Logo.png",
                "group" => "TNT Sports",
                "stream_url" => "https://otte.cache.aiv-cdn.net/iad-nitro/live/clients/dash/enc/2szrn2y3ep/out/v1/eacd8a4207dc4f0d9661a4b085b8fdd9/cenc.mpd",
                "type" => "dash",
                "drm_kid" => "12413e2c2855cfc59ce0fe6b20cc71ca",
                "drm_key" => "08d55a8f5fc93a9375f9b0cb2e1739ca"
            ],
            [
                "name" => "TSN [No VPN]",
                "logo_url" => "https://images.fotmob.com/image_resources/logo/teamlogo/6720.png",
                "group" => "TSN",
                "stream_url" => "https://otte-qw.live.pv-cdn.net/pdx-nitro/live/clients/dash/enc/w0rehjjrwe/out/v1/69a2a7041395406b970598f61680e7cf/cenc.mpd",
                "type" => "dash",
                "drm_kid" => "14eeabf30c14b7fbf3008c03099ce011",
                "drm_key" => "17d2ac8dbc5429bd70af3433aa12158d"
            ],
            [
                "name" => "ARABIC LIVE",
                "logo_url" => "https://images.fotmob.com/image_resources/logo/teamlogo/8570.png",
                "group" => "FIFA",
                "stream_url" => "https://live-aburayhan1111.telewebion.ir/ek/sport1/live/720p/index.m3u8",
                "type" => "hls",
                "drm_kid" => null,
                "drm_key" => null
            ],
            [
                "name" => "CAZE TV",
                "logo_url" => "https://images.seeklogo.com/logo-png/61/1/cazetv-logo-png_seeklogo-619708.png",
                "group" => "FIFA",
                "stream_url" => "https://dfr80qz435crc.cloudfront.net/MNOP/Amagi/Caze/Caze_TV_BR/Caze_TV.m3u8",
                "type" => "hls",
                "drm_kid" => null,
                "drm_key" => null
            ],
            [
                "name" => "CAZE TV (1080p)",
                "logo_url" => "https://images.seeklogo.com/logo-png/61/1/cazetv-logo-png_seeklogo-619708.png",
                "group" => "Sports",
                "stream_url" => "https://dfr80qz435crc.cloudfront.net/MNOP/Amagi/Caze/Caze_TV_BR/1080p-vtt/index.m3u8",
                "type" => "hls",
                "drm_kid" => null,
                "drm_key" => null
            ],
            [
                "name" => "CTV",
                "logo_url" => "https://images.fotmob.com/image_resources/logo/teamlogo/8570.png",
                "group" => "FIFA",
                "stream_url" => "https://otte.cache.aiv-cdn.net/bom-nitro/live/clients/dash/enc/72sjo8hygl/out/v1/3079be34d72a4985852d299a02406a0c/cenc.mpd",
                "type" => "dash",
                "drm_kid" => "d185684e2330de5bea436daa094a5e86",
                "drm_key" => "014f0116154f5bf0050e03a6b0a23157"
            ],
            [
                "name" => "DAZN FIFA",
                "logo_url" => "https://i.postimg.cc/Kc3mP7Qt/cbimage.png",
                "group" => "FIFA",
                "stream_url" => "https://1nyaler.streamhostingcdn.top/stream/94/index.m3u8",
                "type" => "hls",
                "drm_kid" => null,
                "drm_key" => null
            ],
            [
                "name" => "FANCODE HD",
                "logo_url" => "https://cdn.sportmonks.com/images/cricket/teams/5/37.png",
                "group" => "FIFA",
                "stream_url" => "https://abfjk4haaaaaaaampv6ofhkihi4r6.bia-cf.live.pv-cdn.net/iad-nitro/live/clients/dash/enc/fdb3pubmek/out/v1/aefca6420f944a9482e117f315de535f/cenc.mpd",
                "type" => "dash",
                "drm_kid" => "7e9239c1982d984a002df3ed049d0756",
                "drm_key" => "1b8a17598129a3618535c8fb05f103fe"
            ],
            [
                "name" => "FUSSBALL TV (USE GERMAN VPN)",
                "logo_url" => "https://images.fotmob.com/image_resources/logo/teamlogo/6719.png",
                "group" => "FIFA",
                "stream_url" => "https://svc45.main.sl.t-online.de/bpk-tv/KID01037_FUSSBALLTV1_hd/DASH/index.mpd",
                "type" => "dash",
                "drm_kid" => "1cb20afcd9d979c833cfd208c7d3eeb2",
                "drm_key" => "fef0c15b4a523370892edd5e4133c269"
            ],
            [
                "name" => "GOLIVE - English",
                "logo_url" => "https://rtb-images.glueapi.io/320x0/live/GoLiveNew.png",
                "group" => "FIFA",
                "stream_url" => "https://d1211whpimeups.cloudfront.net/smil:rtbgo/chunklist.m3u8",
                "type" => "hls",
                "drm_kid" => null,
                "drm_key" => null
            ],
            [
                "name" => "LVE 1",
                "logo_url" => "https://images.fotmob.com/image_resources/logo/teamlogo/8263.png",
                "group" => "FIFA",
                "stream_url" => "https://pullsgp.yyzb456.top/live/stream-506605_lhd.m3u8",
                "type" => "hls",
                "drm_kid" => null,
                "drm_key" => null
            ],
            [
                "name" => "M6 Direct TV",
                "logo_url" => "https://i.imgur.com/7GVp3fW.png",
                "group" => "FIFA",
                "stream_url" => "https://origin-m6web.live.6cloud.fr/out/v1/6play/6play-m6/cmaf_cenc00/dash-short-hd.mpd",
                "type" => "dash",
                "drm_kid" => "433ffba670963e70857859a9dff4be04",
                "drm_key" => "51ede3a821229fe81e71282c8eff80e3"
            ],
            [
                "name" => "Match! Football 1",
                "logo_url" => "https://images.fotmob.com/image_resources/logo/teamlogo/6719.png",
                "group" => "FIFA",
                "stream_url" => "https://bl.video.matchtv.ru/media/playlist/free_d46d0cf1712c0542ec7fd4f0808f600a_hd/17_89756005/1080/e6bef86de8a133cd7b27deb040758a00/4796141934.m3u8",
                "type" => "hls",
                "drm_kid" => null,
                "drm_key" => null
            ],
            [
                "name" => "RTB",
                "logo_url" => "https://images.fotmob.com/image_resources/logo/teamlogo/6720.png",
                "group" => "FIFA",
                "stream_url" => "https://d1211whpimeups.cloudfront.net/smil:rtb2/playlist.m3u8",
                "type" => "hls",
                "drm_kid" => null,
                "drm_key" => null
            ],
            [
                "name" => "RTE SPORTS",
                "logo_url" => "https://images.fotmob.com/image_resources/logo/teamlogo/6719.png",
                "group" => "FIFA",
                "stream_url" => "https://dai.google.com/linear/dash/event/antwa0EiQm2PoHtx4rBtVw/manifest.mpd",
                "type" => "dash",
                "drm_kid" => "d816287e21496989eae1312925a423c5",
                "drm_key" => "00da00f13180e7e6cd5ce87d1c974e8d"
            ],
            [
                "name" => "SPO TV",
                "logo_url" => "https://resources.motogp.pulselive.com/photo-resources/2026/06/15/4b8f1a01-10ce-4c91-8c14-b906d9f77caf/Czechia-GP-Poster.jpg?height=192&width=343",
                "group" => "FIFA",
                "stream_url" => "https://qp-pldt-live-grp-13-prod.akamaized.net/out/u/dr_spotv2hd.mpd",
                "type" => "dash",
                "drm_kid" => "7eea72d6075245a99ee3255603d58853",
                "drm_key" => "6848ef60575579bf4d415db1032153ed"
            ],
            [
                "name" => "Somoy TV",
                "logo_url" => "https://upload.wikimedia.org/wikipedia/bn/thumb/f/f6/%E0%A6%B8%E0%A6%AE%E0%A6%AF%E0%A6%BC_%E0%A6%9F%E0%A6%BF%E0%A6%AB%E0%A6%BF%E0%A6%B0_%E0%A6%B2%E0%A7%8B%E0%A6%97%E0%A7%8B.svg/960px-%E0%A6%B8%E0%A6%AE%E0%A6%AF%E0%A6%BC_%E0%A6%9F%E0%A6%BF%E0%A6%AB%E0%A6%BF%E0%A6%B0_%E0%A6%B2%E0%A7%8B%E0%A6%97%E0%A7%8B.svg.png?_=20250102083708",
                "group" => "FIFA",
                "stream_url" => "https://live.thebosstv.com:30443/dwlive/Somoy-TV/chunks.m3u8",
                "type" => "hls",
                "drm_kid" => null,
                "drm_key" => null
            ],
            [
                "name" => "TELEMUNDO (USA VPN)",
                "logo_url" => "https://images.fotmob.com/image_resources/logo/teamlogo/6719.png",
                "group" => "FIFA",
                "stream_url" => "https://live-oneapp-prd-news.akamaized.net/Content/CMAF_OL2-CTR-4s-v2/Live/channel(kvea)/master.mpd",
                "type" => "dash",
                "drm_kid" => "ce7ab3022e753307997f58afe001bac4",
                "drm_key" => "72d631a66e635c60829a0fe7705516c1"
            ],
            [
                "name" => "TIPIK HD",
                "logo_url" => "https://images.fotmob.com/image_resources/logo/teamlogo/6719.png",
                "group" => "FIFA",
                "stream_url" => "https://c9851ec-rbm-hilv-fsly.cdn.redbee.live/L26/6b640fa2/a765d074.isml/dash/.mpd",
                "type" => "dash",
                "drm_kid" => "adca25b8779e4168a0cd710f59f61ccf",
                "drm_key" => "be5383ed3cd8079f4ffe78ad067f476a"
            ],
            [
                "name" => "TRT 1",
                "logo_url" => "https://images.seeklogo.com/logo-png/26/2/trt-1-logo-png_seeklogo-260967.png",
                "group" => "FIFA",
                "stream_url" => "https://tv-trt1.medya.trt.com.tr/master.m3u8",
                "type" => "hls",
                "drm_kid" => null,
                "drm_key" => null
            ],
            [
                "name" => "TUDN",
                "logo_url" => "https://images.fotmob.com/image_resources/logo/teamlogo/8570.png",
                "group" => "FIFA",
                "stream_url" => "https://vod-sev-orbit2-s2.izzigo.tv/out/u/startover/dash/VIX-MUNDIAL-90-HD/default.mpd",
                "type" => "dash",
                "drm_kid" => "75074a0cbd83f5b72fb3e5c1495252a9",
                "drm_key" => "a4a0df04b2d28f2160cead2ecdeb7203"
            ],
            [
                "name" => "ZDF (USE GERMAN VPN)",
                "logo_url" => "https://images.fotmob.com/image_resources/logo/teamlogo/6720.png",
                "group" => "FIFA",
                "stream_url" => "https://simplitv-live.mdn.ors.at/live/eds/zdf_hd/dash4h/zdf_hd.mpdhttps://simplitv-live.mdn.ors.at/live/eds/zdf_hd/dash4h/zdf_hd.mpd",
                "type" => "dash",
                "drm_kid" => "c1a0ac1044a433d0856ccdc08f245084",
                "drm_key" => "7f0e8800a6d63d7915ac181bb88ce813"
            ],
            [
                "name" => "iOS 2",
                "logo_url" => "https://carboncredits.com/wp-content/uploads/2025/09/shutterstock_2306088965-e1757112807302.jpg",
                "group" => "FIFA",
                "stream_url" => "https://hugh.cdn.rumble.cloud/live/y16rq9u0/slot-13/2rvn-cv3b_360p/chunklist_DVR.m3u8",
                "type" => "hls",
                "drm_kid" => null,
                "drm_key" => null
            ],
            [
                "name" => "Win Sports [No VPN]",
                "logo_url" => "https://upload.wikimedia.org/wikipedia/commons/thumb/5/58/Win_Sports_nuevo_logo.svg/500px-Win_Sports_nuevo_logo.svg.png",
                "group" => "FIFA",
                "stream_url" => "https://1nyaler.streamhostingcdn.top/stream/32/index.m3u8",
                "type" => "hls",
                "drm_kid" => null,
                "drm_key" => null
            ],
            [
                "name" => "D Sports HD",
                "logo_url" => "https://i.imgur.com/12yqgbL.png",
                "group" => "D Sports",
                "stream_url" => "https://otte.live.fly.ww.aiv-cdn.net/gru-nitro/live/clients/dash/enc/3gg2jnixjn/out/v1/e1840e01f3f14563b66bbb944d5cc54c/cenc.mpd",
                "type" => "dash",
                "drm_kid" => "f8b207c10f3f76aeba32a360ec52b9e4",
                "drm_key" => "afad49d20eb39670e93e371c1d669921"
            ],
            [
                "name" => "TSN Sports 4 - English",
                "logo_url" => "https://i.imgur.com/qJyAWU8.png",
                "group" => "TSN",
                "stream_url" => "https://otte-qw.live.pv-cdn.net/bom-nitro/live/clients/dash/enc/w0rehjjrwe/out/v1/69a2a7041395406b970598f61680e7cf/cenc.mpd?Null",
                "type" => "dash",
                "drm_kid" => "14eeabf30c14b7fbf3008c03099ce011",
                "drm_key" => "17d2ac8dbc5429bd70af3433aa12158d"
            ],
            [
                "name" => "TELEMUNDO FHD",
                "logo_url" => "https://www.bellmedia.ca/lede/wp-content/uploads/2024/09/18581592_10155403529061055_8240563011649656197_n.jpg",
                "group" => "TELEMUNDO",
                "stream_url" => "https://cun-live1-ott.izzigo.tv/out/u/dash/NOG1/TELEMUNDO-ARIZONA-USA-TCS-HD/default.mpd",
                "type" => "dash",
                "drm_kid" => "1efe4add8fdf327c5f8d2a1c195e5c71",
                "drm_key" => "4f50e6f011e60ca01ee561f27187e78f"
            ],
            [
                "name" => "TRT SPORTS 2K",
                "logo_url" => "",
                "group" => "TRT",
                "stream_url" => "https://rxne77juptdeyke3tytvgqwyh.medya.trt.com.tr/master.m3u8",
                "type" => "hls",
                "drm_kid" => null,
                "drm_key" => null
            ],
            [
                "name" => "IRIB 4K",
                "logo_url" => "",
                "group" => "IRIB",
                "stream_url" => "https://ncdn.telewebion.ir/faratar/live/playlist.m3u8",
                "type" => "hls",
                "drm_kid" => null,
                "drm_key" => null
            ],
            [
                "name" => "TVP SPORTS FHD",
                "logo_url" => "",
                "group" => "TVP",
                "stream_url" => "https://estreams.tv.nej.cz/dash/CH_TVP_SPORT_Portable.ism/playlist.mpd",
                "type" => "dash",
                "drm_kid" => "0",
                "drm_key" => "0"
            ],
            [
                "name" => "JOJ SPORTS FHD",
                "logo_url" => "",
                "group" => "JOJ",
                "stream_url" => "https://dash2.antik.sk/stream/nvidia_joj_sport/playlist_cenc.mpd",
                "type" => "dash",
                "drm_kid" => "11223344556677889900112233445566",
                "drm_key" => "4b80724d0ef86bcb2c21f7999d67739d"
            ],
            [
                "name" => "ARABIC LIVE HD",
                "logo_url" => "",
                "group" => "ARABIC",
                "stream_url" => "https://43cup.s3.us-east-2.amazonaws.com/max4/master.m3u8",
                "type" => "hls",
                "drm_kid" => null,
                "drm_key" => null
            ]
        ];

        foreach ($channels as $chan) {
            Channel::updateOrCreate(
                ['name' => $chan['name']],
                $chan
            );
        }
    }
}
