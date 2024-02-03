@extends('layout')
@section('content')
    <div class="kfb-section-container">
        <div class="kfb-match-detail-wrapper">
            <h1 class="kfb-article-title">Trực tiếp kết quả Man City vs Inter hôm nay 11-06-2023</h1>
            <div class="kfb-live-text">
                <h2 class="kfb-f-text">Giải Champions League - CN, 11/6</h2>
                <span class="kfb-f-end">Kết thúc</span>
            </div>

            <div>
                <!-- The match score block -->
                <div class="kfb-match-score">
                    <div class="kfb-c1-result">
                        <div class="kfb-logo-thumb-1">
                            <a href="#" title="Man City">
                                <img alt="Man City"
                                    src="https://static.bongda24h.vn/Medias/original/2017/6/26/manchester-city.jpg">
                            </a>
                        </div>
                        <div class="kfb-name-clb-1">
                            <h3>
                                <a href="/clubs/man-city-1471.html" title="Man City">Man City</a>
                            </h3>
                        </div>
                    </div>
                    <div class="kfb-c2-result">1 : 0</div>
                    <div class="kfb-c3-result">
                        <div class="kfb-name-clb-2">
                            <h3>
                                <a href="/clubs/inter-milan-1399.html" title="Inter">Inter</a>
                            </h3>
                        </div>
                        <div class="kfb-logo-thumb-2">
                            <a href="/clubs/inter-milan-1399.html" title="Inter">
                                <img alt="Inter"
                                    src="https://static.bongda24h.vn/Medias/original/2023/04/10/logo-inter-milan-1004093333.jpg">
                            </a>
                        </div>
                    </div>
                </div>

                <!-- The match metadata block -->
                <div class="kfb-match-metadata">
                    <div class="kfb-row-0">
                        Hiệp một: <span class="kfb-c-red">0-0</span>
                    </div>
                    <div class="kfb-row-text">
                        <div class="kfb-div-row kfb-r1">
                            <img class="kfb-icon-th1" src="/images/icons/ic-time.png">CN, 02:00 11/06/2023
                        </div>
                        <div class="kfb-div-row kfb-l1">
                            <img class="kfb-icon-th2" src="/images/icons/ic-live.png">
                            Chung kết - Champions League
                        </div>
                    </div>
                    <div class="kfb-row-text">
                        <div class="kfb-div-row kfb-r1">
                            <img class="kfb-icon-th1" src="/images/icons/ic-svd.png">
                            Ataturk Olympic Stadium
                        </div>
                        <div class="kfb-div-row kfb-l1">
                            <img class="kfb-icon-th2" src="/images/icons/icon-03.png">
                            FPT Play
                        </div>
                    </div>
                </div>

                <!-- The tabs neo block -->
                <div class="kfb-tabs-neo"  id="kfb-events">
                    <a href="#kfb-events" class="kfb-tabs-neo-item kfb-active">Tổng quan</a>
                    <a href="#sec2" class="kfb-tabs-neo-item">Diễn biến</a>
                    <a href="#sec3" class="kfb-tabs-neo-item">Đội hình</a>
                    {{-- <a href="#sec4" class="kfb-tabs-neo-item">Nhận định</a> --}}
                    <a href="#kfb-statistics" class="kfb-tabs-neo-item">Thống kê</a>
                    <a href="#sec6" class="kfb-tabs-neo-item">Đối đầu</a>
                    {{-- <a href="#sec7" class="kfb-tabs-neo-item">Tin tức</a> --}}
                    <a href="#sec8" class="kfb-tabs-neo-item">BXH</a>
                </div>
            </div>

            <!-- Style for events block -->
            <div class="kfb-events-wrapper">
                <ul class="kfb-ul-live">
                    <li>
                        Phil Foden (Thay: Kevin De Bruyne)
                        <span class="kfb-ic-the">
                            <img src="/images/icons/substitution.png">
                            36
                        </span>
                    </li>
                    <li>
                        Rodri
                        <span class="kfb-ic-the">
                            <img src="/images/icons/goal.png">
                            68
                        </span>
                    </li>
                    <li>
                        Kyle Walker (Thay: John Stones)
                        <span class="kfb-ic-the">
                            <img src="/images/icons/substitution.png">
                            82
                        </span>
                    </li>
                    <li>
                        Erling Haaland
                        <span class="kfb-ic-the">
                            <img src="/images/icons/yellow_card.png">
                            90+2'
                        </span>
                    </li>
                    <li>
                        Ederson Moraes
                        <span class="kfb-ic-the">
                            <img src="/images/icons/yellow_card.png">
                            90+4'
                        </span>
                    </li>
                </ul>
                <ul class="kfb-ul-live">
                    <li>
                        Romelu Lukaku (Thay: Edin Dzeko)
                        <span class="kfb-ic-the">
                            <img src="/images/icons/substitution.png">
                            57
                        </span>
                    </li>
                    <li>
                        Nicolo Barella
                        <span class="kfb-ic-the">
                            <img src="/images/icons/yellow_card.png">
                            59
                        </span>
                    </li>
                    <li>
                        Robin Gosens (Thay: Alessandro Bastoni)
                        <span class="kfb-ic-the">
                            <img src="/images/icons/substitution.png">
                            76
                        </span>
                    </li>
                </ul>
            </div>

            <!-- Match statistics block -->
            <div class="kfb-live-content" id="kfb-statistics">
                <h2>Thống kê trận đấu Man City vs Inter</h2>
                <div class="kfb-box-center">
                    <div class="kfb-box-statistics">
                        <div class="kfb-statis-row">số liệu thống kê</div>
                        <div class="kfb-statistics-head">
                            <div class="kfb-statis-col">
                                <img alt="Man City"
                                    src="https://static.bongda24h.vn/Medias/original/2017/6/26/manchester-city.jpg">
                                <div class="kfb-name-clb-statis">
                                    <div class="kfb-middle-align">Man City</div>
                                </div>
                            </div>
                            <div class="kfb-statis-col">
                                <img class="kfb-img-clb-statis-2" alt="Inter"
                                    src="https://static.bongda24h.vn/Medias/original/2023/04/10/logo-inter-milan-1004093333.jpg">
                                <div class="kfb-name-clb-statis kfb-name-clb-statis-2">
                                    <div class="kfb-middle-align">Inter</div>
                                </div>
                            </div>
                        </div>
                        <div class="kfb-statistics-row">
                            <div class="kfb-statistics-item">
                                <span class="kfb-statistics-number-1 kfb-bg-number-1">57</span>
                                <span class="kfb-statistics-text kfb-c-white">Kiểm soát bóng</span>
                                <span class="kfb-statistics-number-2 kfb-bg-number-2">43</span>
                                <span class="kfb-bg-auto-statistics-1" style="width:57%"></span>
                                <span class="kfb-bg-auto-statistics-2" style="width:43%"></span>
                            </div>
                        </div>
                        <div class="kfb-statistics-row">
                            <div class="kfb-statistics-item">
                                <span class="kfb-statistics-number-1">11</span>
                                <span class="kfb-statistics-text">Phạm lỗi</span>
                                <span class="kfb-statistics-number-2 kfb-bg-number-2">17</span>
                            </div>
                        </div>
                        <div class="kfb-statistics-row">
                            <div class="kfb-statistics-item">
                                <span class="kfb-statistics-number-1">16</span>
                                <span class="kfb-statistics-text">Ném biên</span>
                                <span class="kfb-statistics-number-2 kfb-bg-number-2">19</span>
                            </div>
                        </div>
                        <div class="kfb-statistics-row">
                            <div class="kfb-statistics-item">
                                <span class="kfb-statistics-number-1">1</span>
                                <span class="kfb-statistics-text">Việt vị</span>
                                <span class="kfb-statistics-number-2">1</span>
                            </div>
                        </div>
                        <div class="kfb-statistics-row">
                            <div class="kfb-statistics-item"><span class="kfb-statistics-number-1">10</span> <span
                                    class="kfb-statistics-text">Chuyền dài</span> <span
                                    class="kfb-statistics-number-2 kfb-bg-number-2">16</span></div>
                        </div>
                        <div class="kfb-statistics-row">
                            <div class="kfb-statistics-item"><span class="kfb-statistics-number-1">2</span> <span
                                    class="kfb-statistics-text">Phạt góc</span> <span
                                    class="kfb-statistics-number-2 kfb-bg-number-2">4</span></div>
                        </div>
                        <div class="kfb-statistics-row">
                            <div class="kfb-statistics-item"><span class="kfb-statistics-number-1">2</span> <span
                                    class="kfb-statistics-text">Thẻ vàng</span> <span
                                    class="kfb-statistics-number-2 kfb-bg-number-2">3</span></div>
                        </div>
                        <div class="kfb-statistics-row">
                            <div class="kfb-statistics-item"><span class="kfb-statistics-number-1">0</span> <span
                                    class="kfb-statistics-text">Thẻ đỏ</span>
                                    <span class="kfb-statistics-number-2">0</span></div>
                        </div>
                        <div class="kfb-statistics-row">
                            <div class="kfb-statistics-item">
                                <span class="kfb-statistics-number-1">0</span> <span
                                    class="kfb-statistics-text">Thẻ vàng thứ 2</span> <span
                                    class="kfb-statistics-number-2">0</span></div>
                        </div>
                        <div class="kfb-statistics-row">
                            <div class="kfb-statistics-item"><span class="kfb-statistics-number-1">4</span> <span
                                    class="kfb-statistics-text">Sút trúng đích</span> <span
                                    class="kfb-statistics-number-2 kfb-bg-number-2">5</span></div>
                        </div>
                        <div class="kfb-statistics-row">
                            <div class="kfb-statistics-item"><span class="kfb-statistics-number-1">3</span> <span
                                    class="kfb-statistics-text">Sút không trúng đích</span> <span
                                    class="kfb-statistics-number-2 kfb-bg-number-2">7</span></div>
                        </div>
                        <div class="kfb-statistics-row">
                            <div class="kfb-statistics-item">
                                <span class="kfb-statistics-number-1">0</span>
                                <span class="kfb-statistics-text">Cú sút bị chặn</span>
                                <span class="kfb-statistics-number-2 kfb-bg-number-2">2</span>
                            </div>
                        </div>
                        <div class="kfb-statistics-row">
                            <div class="kfb-statistics-item">
                                <span class="kfb-statistics-number-1 kfb-bg-number-1">5</span>
                                <span class="kfb-statistics-text">Phản công</span>
                                <span class="kfb-statistics-number-2">1</span>
                            </div>
                        </div>
                        <div class="kfb-statistics-row">
                            <div class="kfb-statistics-item">
                                <span class="kfb-statistics-number-1 kfb-bg-number-1">5</span>
                                <span class="kfb-statistics-text">Thủ môn cản phá</span>
                                <span class="kfb-statistics-number-2">3</span>
                            </div>
                        </div>
                        <div class="kfb-statistics-row">
                            <div class="kfb-statistics-item">
                                <span class="kfb-statistics-number-1 kfb-bg-number-1">8</span>
                                <span class="kfb-statistics-text">Phát bóng</span>
                                <span class="kfb-statistics-number-2">7</span>
                            </div>
                        </div>
                        <div class="kfb-statistics-row">
                            <div class="kfb-statistics-item">
                                <span class="kfb-statistics-number-1 kfb-bg-number-1">2</span>
                                <span class="kfb-statistics-text">Chăm sóc y tế</span>
                                <span class="kfb-statistics-number-2">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lineups block -->
            @include('truc-tiep.partials.lineups')
        </div>
    </div>
@endsection
