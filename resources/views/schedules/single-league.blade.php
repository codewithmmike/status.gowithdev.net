@extends('layout')
@section('content')
    <div class="kfb-section-container" id="ltd_kq_byleague'">
        @include('schedules.partails.round-list')

        <div class="kfb-table-headering">
            <div class="kfb-current-round">
                Vòng đấu hiện tại: <strong class="kfb-c-red">Vòng 19</strong>
            </div>
            <h2 class="kfb-table-header">Kết quả Ngoại hạng Anh</h2>
            <div class="kfb-item-fright">
                <a title="Lịch thi đấu Ngoại hạng Anh" href="#">Lịch thi đấu Ngoại hạng Anh</a>
                <a title="Bảng xếp hạng Ngoại hạng Anh" href="#">Bảng xếp hạng Ngoại hạng Anh</a>
            </div>
        </div>

        <div class="kfb-table-livescore kfb-calc">
            <!-- Search box -->
            <div class="kfb-form-match">
                <div class="kfb-form-match-w">
                    <input class="kfb-search-match" placeholder="Tìm kiếm trận đấu, giải đấu hôm nay, ngày mai">
                    <span class="kfb-btn-search-match">
                        {{-- <i class="fa fa-search"></i> --}}
                        <i class="kfb-fa-search"></i>
                    </span>
                </div>
            </div>

            <!-- Main horizontal tabs -->
            <div class="kfb-tabnav">
                <span class="kfb-tablink kfb-active" onclick="openPage('all',this)" data="all">Tất cả</span>
                <span class="kfb-tablink" onclick="openPage('hot',this)" data="hot">
                    HOT
                    <i class="kfb-fa-bolt"></i>
                </span>
                <span class="kfb-tablink" onclick="openPage('just',this)" data="just">Vừa diễn ra</span>
                <span class="kfb-tablink" onclick="openPage('happenning',this)" data="happenning">Đang diễn ra</span>
                <span class="kfb-tablink" onclick="openPage('coming',this)" data="coming">Sắp diễn ra</span>
            </div>

            <div class="kfb-tabnav-content" id="ltd_byleague">
                <!-- League item -->
                <div class="kfb-match-football-item" id="ltd1">
                    <!-- League header -->
                    <div class="kfb-football-header">
                        <h3 class="kfb-head-left">
                            <a class="kfb-active" title="Lịch thi đấu Ngoại hạng Anh" href="#">
                                Lịch thi đấu Premier League
                            </a>
                        </h3>
                        <div class="kfb-head-right">
                            <a class="kfb-active" title="Lịch thi đấu Ngoại hạng Anh" href="#">LTĐ</a> |
                            <a title="Kết quả Ngoại hạng Anh" href="#">KQ</a> |
                            <a title="Bảng xếp hạng Ngoại hạng Anh" href="#">BXH</a>
                        </div>
                    </div>

                    <!-- Match item info -->
                    <div class="kfb-f-row kfb-match-detail kfb-hot kfb-just kfb-comming kfb-happenning" data-leagueid="1"
                        data="Liverpool Arsenal Premier League Ngoại hạng Anh Bóng đá Anh Bong da Anh Ngoai hang Anh Premier League"
                        data-date="24-12">
                        <div class="kfb-row-match">
                            <span class="kfb-item-kenh">K+SPORT1 - K+SPORT2</span>
                            <div class="kfb-right">
                                <a href="#" class="kfb-item-ktv"
                                    title="Nhận định Liverpool vs Arsenal (00h30 ngày 24/12): Vượt cửa ải Anfield">
                                    Nhận định
                                </a>
                                <span class="kfb-item-ktv">|</span>
                                <a href="#"
                                    title="Liverpool bất phân thắng bại với Arsenal trong trận chiến nơi đỉnh bảng"
                                    class="kfb-item-ktv">Trực tiếp</a>
                            </div>
                        </div>

                        <div class="kfb-football-match">
                            <div class="kfb-columns-time">
                                <span class="kfb-time"> 00:30 </span>
                                <span class="kfb-separator kfb-m-hidden">-</span>
                                <span class="kfb-date">24/12</span>
                                <span class="kfb-first-round kfb-m-hidden" title="Vòng 18"> 18 </span>
                                <span class="kfb-live kfb-m-hidden">
                                    <img alt="live" class="kfb-fa-spin" src="/images/live-sc.png">
                                </span>
                            </div>
                            <div class="kfb-columns-match">
                                <div class="kfb-row-teams">
                                    <div class="kfb-columns-club">
                                        <a class="kfb-name-club kfb-club-1 kfb-c-red" href="#" title="Liverpool">
                                            Liverpool
                                            <img class="kfb-logo-club lazyload" alt="Liverpool"
                                                src="https://static.bongda24h.vn/Medias/icon/2020/7/23/Liverpool.png">
                                        </a>
                                    </div>
                                    <div class="kfb-columns-number">
                                        <span class="kfb-soccer-scores">1 - 1</span>
                                    </div>
                                    <div class="kfb-columns-club">
                                        <a class="kfb-name-club kfb-club-2 kfb-c-red" href="#" title="Arsenal">
                                            Arsenal
                                            <img class="kfb-logo-club lazyload" alt="Arsenal"
                                                src="https://static.bongda24h.vn/Medias/icon/2020/7/23/Arsenal.png">
                                        </a>
                                    </div>
                                </div>
                                <div class="kfb-row-match-info">
                                    <div class="kfb-item-ktv">
                                        <span title="Tỷ số hiệp 1">H1:</span> 1-1
                                    </div>
                                    <div class="kfb-hiep-phu" title="Trận đấu đã hoãn">Hoãn</div>
                                </div>
                            </div>
                            <div class="kfb-columns-other">
                                <div class="kfb-flex-right">
                                    <div class="kfb-item-other-1 kfb-m-hidden">
                                        <a class="kfb-first-half"
                                            href="/nhan-dinh-bong-da/nhan-dinh-liverpool-vs-arsenal-ngoai-hang-anh-344-373988.html"
                                            title="Nhận định Liverpool vs Arsenal (00h30 ngày 24/12): Vượt cửa ải Anfield">NĐ</a>
                                    </div>
                                    <div class="kfb-item-other-2 kfb-m-hidden">
                                        <a class="kfb-first-half" href="#"
                                            title="Liverpool bất phân thắng bại với Arsenal trong trận chiến nơi đỉnh bảng">TT</a>
                                    </div>
                                    <div class="kfb-item-other-3 kfb-m-hidden">
                                        <span title="Xem kênh">K+SPORT1; K+SPORT2</span>
                                    </div>
                                    <div class="kfb-item-other-4">
                                        <a class="kfb-btn-f-more"
                                            title="Xem thông tin chi tiết Liverpool vs Arsenal"
                                            href="#">
                                            <i class="kfb-fa-chevron-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="kfb-f-row kfb-match-detail kfb-hot" data-leagueid="1"
                        data="Wolves Chelsea Premier League Ngoại hạng Anh Bóng đá Anh Bong da Anh Ngoai hang Anh Premier League"
                        data-date="24-12">
                        <div class="kfb-row-match"><span class="kfb-item-kenh">K+SPORT1</span>
                            <div class="kfb-right">
                                <a href="/nhan-dinh-bong-da/du-doan-wolves-vs-chelsea-hom-nay-344-374096.html"
                                    title="Nhận định Wolves vs Chelsea (20h00 ngày 24/12): Hiểm địa Molineux"
                                    class="kfb-item-ktv">Nhận định
                                </a>
                            </div>
                        </div>
                        <div class="kfb-football-match">
                            <div class="kfb-columns-time">
                                <span class="kfb-time"> 20:00 </span>
                                <span class="kfb-separator kfb-m-hidden">-</span>
                                <span class="kfb-date">24/12</span>
                                <span class="kfb-first-round kfb-m-hidden" title="Vòng 18"> 18 </span>
                            </div>
                            <div class="kfb-columns-match">
                                <div class="kfb-row-teams">
                                    <div class="kfb-columns-club">
                                        <a class="kfb-name-club kfb-club-1 kfb-c-red" href="/clubs/wolves-1458.html"
                                            title="Wolves"> Wolves <img class="kfb-logo-club lazyload" alt="Wolves"
                                                src="https://static.bongda24h.vn/Medias/icon/2020/8/12/Wolves.png"
                                                data-src="https://static.bongda24h.vn/Medias/icon/2020/8/12/Wolves.png">
                                        </a>
                                    </div>
                                    <div class="kfb-columns-number">
                                        <span class="kfb-soccer-scores">vs</span>
                                    </div>
                                    <div class="kfb-columns-club"><a class="kfb-name-club kfb-club-2 kfb-c-red"
                                            href="/clubs/chelsea-6.html" title="Chelsea"> Chelsea <img
                                                class="kfb-logo-club lazyload" alt="Chelsea"
                                                src="https://static.bongda24h.vn/Medias/icon/2020/7/23/Chelsea.png"
                                                data-src="https://static.bongda24h.vn/Medias/icon/2020/7/23/Chelsea.png">
                                        </a></div>
                                </div>
                            </div>
                            <div class="kfb-columns-other">
                                <div class="kfb-flex-right">
                                    <div class="kfb-item-other-1 kfb-m-hidden"><a class="kfb-first-half"
                                            href="/nhan-dinh-bong-da/du-doan-wolves-vs-chelsea-hom-nay-344-374096.html"
                                            title="Nhận định Wolves vs Chelsea (20h00 ngày 24/12): Hiểm địa Molineux">NĐ</a>
                                    </div>
                                    <div class="kfb-item-other-2 kfb-m-hidden"></div>
                                    <div class="kfb-item-other-3 f-tv kfb-m-hidden"><span title="Xem kênh">K+SPORT1</span>
                                    </div>
                                    <div class="kfb-item-other-4"><a title="Xem thông tin chi tiết Wolves vs Chelsea"
                                            rel="nofollow" class="btn-f-more"
                                            href="/truc-tiep-ket-qua/wolves-vs-chelsea-152906.html"><i
                                                class="fas fa-chevron-right"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="kfb-match-football-item" id="ltd3">
                    <div class="kfb-football-header">
                        <h3 class="kfb-head-left"><a class="kfb-active" title="Lịch thi đấu Serie A"
                                href="/bong-da-italia/lich-thi-dau-3.html"> Lịch thi đấu Serie A </a></h3>
                        <div class="kfb-head-right"><a class="kfb-active" title="Lịch thi đấu Serie A"
                                href="/bong-da-italia/lich-thi-dau-3.html">LTĐ</a> | <a title="Kết quả Serie A"
                                href="/bong-da-italia/ket-qua-3.html">KQ</a> | <a title="Bảng xếp hạng Serie A"
                                href="/bong-da-italia/bang-xep-hang-3.html">BXH</a></div>
                    </div>
                    <div class="kfb-f-row kfb-match-detail kfb-hot" data-leagueid="3"
                        data="Inter Lecce Serie A Serie A Bóng đá Italia Bong da Italia Serie A Serie A"
                        data-date="24-12">
                        <div class="kfb-row-match"><span class="kfb-item-kenh">ON Sports+</span>
                            <div class="kfb-right"></div>
                        </div>
                        <div class="kfb-football-match">
                            <div class="kfb-columns-time"><span class="kfb-time"> 00:00 </span> <span
                                    class="kfb-separator kfb-m-hidden">-</span> <span class="kfb-date">24/12</span> <span
                                    class="kfb-first-round kfb-m-hidden" title="Vòng 17"> 17 </span></div>
                            <div class="kfb-columns-match">
                                <div class="kfb-row-teams">
                                    <div class="kfb-columns-club">
                                        <a class="kfb-name-club kfb-club-1 kfb-c-yellow"
                                            href="/clubs/inter-milan-1399.html" title="Inter"> Inter
                                            <img
                                                class="kfb-logo-club lazyload" alt="Inter"
                                                src="https://static.bongda24h.vn/Medias/icon/2023/04/10/logo-inter-milan-1004093333.jpg"
                                                data-src="https://static.bongda24h.vn/Medias/icon/2023/04/10/logo-inter-milan-1004093333.jpg">
                                            <span class="kfb-cards">
                                                <span class="kfb-yellow-card">2</span>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="kfb-columns-number">
                                        <span class="kfb-soccer-scores">2 - 0</span>
                                    </div>
                                    <div class="kfb-columns-club">
                                        <a class="kfb-name-club kfb-club-2 kfb-c-red"
                                            href="/clubs/lecce-2444.html" title="Lecce"> Lecce
                                            <img
                                                class="kfb-logo-club lazyload" alt="Lecce"
                                                src="https://static.bongda24h.vn/Medias/icon/2019/9/6/Us_lecce.jpg">
                                            <span class="kfb-cards">
                                                <span class="kfb-red-card">1</span>
                                                <span class="kfb-yellow-card">2</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="kfb-row-match-info">
                                    <span class="kfb-item-ktv">
                                        <span title="Tỷ số hiệp 1">H1:</span> 1-0
                                    </span>
                                </div>
                            </div>
                            <div class="kfb-columns-other">
                                <div class="kfb-flex-right">
                                    <div class="kfb-item-other-1 kfb-m-hidden"></div>
                                    <div class="kfb-item-other-2 kfb-m-hidden"></div>
                                    <div class="kfb-item-other-3 f-tv kfb-m-hidden"><span title="Xem kênh">ON
                                            Sports+</span></div>
                                    <div class="kfb-item-other-4"><a title="Xem thông tin chi tiết Inter vs Lecce"
                                            rel="follow" class="btn-f-more"
                                            href="/truc-tiep-ket-qua/inter-vs-lecce-165753.html"><i
                                                class="fas fa-chevron-right"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kfb-f-row kfb-match-detail" data-leagueid="3"
                        data="Verona Cagliari Serie A Serie A Bóng đá Italia Bong da Italia Serie A Serie A"
                        data-date="24-12">
                        <div class="kfb-row-match"><span class="kfb-item-kenh">ON Sports</span>
                            <div class="kfb-right"></div>
                        </div>
                        <div class="kfb-football-match">
                            <div class="kfb-columns-time"><span class="kfb-time"> 00:00 </span> <span
                                    class="kfb-separator kfb-m-hidden">-</span> <span class="kfb-date">24/12</span> <span
                                    class="kfb-first-round kfb-m-hidden" title="Vòng 17"> 17 </span></div>
                            <div class="kfb-columns-match">
                                <div class="kfb-row-teams">
                                    <div class="kfb-columns-club"><a class="kfb-name-club kfb-club-1"
                                            href="/clubs/verona-2443.html" title="Verona"> Verona <img
                                                class="kfb-logo-club lazyload" alt="Verona"
                                                src="https://static.bongda24h.vn/Medias/icon/2019/9/6/HellasVerona.jpg"
                                                data-src="https://static.bongda24h.vn/Medias/icon/2019/9/6/HellasVerona.jpg">
                                        </a></div>
                                    <div class="kfb-columns-number">
                                        <p onclick="getMatchinfo(165759)"><span class="kfb-soccer-scores">2 - 0</span></p>
                                    </div>
                                    <div class="kfb-columns-club"><a class="kfb-name-club kfb-club-2"
                                            href="/clubs/cagliari-47.html" title="Cagliari"> Cagliari <img
                                                class="kfb-logo-club lazyload" alt="Cagliari"
                                                src="https://static.bongda24h.vn/Medias/icon/2022/11/21/cagliari-2111153924.png"
                                                data-src="https://static.bongda24h.vn/Medias/icon/2022/11/21/cagliari-2111153924.png">
                                            <span class="kfb-red-card" title="Thẻ đỏ">1</span> </a></div>
                                </div>
                                <div class="kfb-row-match-info"><span class="kfb-item-ktv"><span
                                            title="Tỷ số hiệp 1">H1:</span>
                                        0-0</span></div>
                            </div>
                            <div class="kfb-columns-other">
                                <div class="kfb-flex-right">
                                    <div class="kfb-item-other-1 kfb-m-hidden"></div>
                                    <div class="kfb-item-other-2 kfb-m-hidden"></div>
                                    <div class="kfb-item-other-3 f-tv kfb-m-hidden"><span title="Xem kênh">ON
                                            Sports</span></div>
                                    <div class="kfb-item-other-4"><a title="Xem thông tin chi tiết Verona vs Cagliari"
                                            rel="follow" class="btn-f-more"
                                            href="/truc-tiep-ket-qua/verona-vs-cagliari-165759.html"><i
                                                class="fas fa-chevron-right"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kfb-f-row kfb-match-detail kfb-hot" data-leagueid="3"
                        data="Roma Napoli Serie A Serie A Bóng đá Italia Bong da Italia Serie A Serie A"
                        data-date="24-12">
                        <div class="kfb-row-match">
                            <span class="kfb-item-kenh">ON Sports+</span>
                            <div class="kfb-right"><a href="#"
                                    title="Nhận định Roma vs Napoli (02h45 ngày 24/12): Giành giật sự sống"
                                    class="kfb-item-ktv">Nhận định</a></div>
                        </div>
                        <div class="kfb-football-match">
                            <div class="kfb-columns-time"><span class="kfb-time"> 02:45 </span> <span
                                    class="kfb-separator kfb-m-hidden">-</span> <span class="kfb-date">24/12</span> <span
                                    class="kfb-first-round kfb-m-hidden" title="Vòng 17"> 17 </span></div>
                            <div class="kfb-columns-match">
                                <div class="kfb-row-teams">
                                    <div class="kfb-columns-club"><a class="kfb-name-club kfb-club-1 kfb-c-red"
                                            href="/clubs/as-roma-57.html" title="Roma"> Roma <img
                                                class="kfb-logo-club lazyload" alt="Roma"
                                                src="https://static.bongda24h.vn/Medias/icon/2022/11/21/roma-2111152029.png"
                                                data-src="https://static.bongda24h.vn/Medias/icon/2022/11/21/roma-2111152029.png">
                                        </a></div>
                                    <div class="kfb-columns-number">
                                        <p onclick="getMatchinfo(165755)"><span class="kfb-soccer-scores">2 - 0</span></p>
                                    </div>
                                    <div class="kfb-columns-club"><a class="kfb-name-club kfb-club-2 kfb-c-red"
                                            href="/clubs/napoli-58.html" title="Napoli"> Napoli <img
                                                class="kfb-logo-club lazyload" alt="Napoli"
                                                src="https://static.bongda24h.vn/Medias/icon/2020/8/12/Napoli.png"
                                                data-src="https://static.bongda24h.vn/Medias/icon/2020/8/12/Napoli.png">
                                            <span class="kfb-red-card" title="Thẻ đỏ">2</span> </a></div>
                                </div>
                                <div class="kfb-row-match-info"><span class="kfb-item-ktv"><span
                                            title="Tỷ số hiệp 1">H1:</span>
                                        0-0</span></div>
                            </div>
                            <div class="kfb-columns-other">
                                <div class="kfb-flex-right">
                                    <div class="kfb-item-other-1 kfb-m-hidden"><a class="kfb-first-half"
                                            href="/nhan-dinh-bong-da/nhan-dinh-roma-vs-napoli-serie-a-344-373991.html"
                                            title="Nhận định Roma vs Napoli (02h45 ngày 24/12): Giành giật sự sống">NĐ</a>
                                    </div>
                                    <div class="kfb-item-other-2 kfb-m-hidden"></div>
                                    <div class="kfb-item-other-3 f-tv kfb-m-hidden"><span title="Xem kênh">ON
                                            Sports+</span></div>
                                    <div class="kfb-item-other-4"><a title="Xem thông tin chi tiết Roma vs Napoli"
                                            rel="follow" class="btn-f-more"
                                            href="/truc-tiep-ket-qua/roma-vs-napoli-165755.html"><i
                                                class="fas fa-chevron-right"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kfb-match-football-item" id="ltd21">
                    <div class="kfb-football-header">
                        <h3 class="kfb-head-left"><a class="kfb-active" title="Lịch thi đấu VĐQG Bỉ"
                                href="/vdqg-bi/lich-thi-dau-21.html"> Lịch thi đấu VĐQG Bỉ </a></h3>
                        <div class="kfb-head-right"><a class="kfb-active" title="Lịch thi đấu VĐQG Bỉ"
                                href="/vdqg-bi/lich-thi-dau-21.html">LTĐ</a> | <a title="Kết quả VĐQG Bỉ"
                                href="/vdqg-bi/ket-qua-21.html">KQ</a> | <a title="Bảng xếp hạng VĐQG Bỉ"
                                href="/vdqg-bi/bang-xep-hang-21.html">BXH</a></div>
                    </div>
                    <div class="kfb-f-row kfb-match-detail" data-leagueid="21"
                        data="Royal Antwerp Westerlo VĐQG Bỉ VĐQG Bỉ VĐQG Bỉ VDQG Bi VDQG Bi VDQG Bi" data-date="24-12">
                        <div class="kfb-row-match">
                            <div class="kfb-right"><a
                                    href="/nhan-dinh-bong-da/soi-keo-antwerp-vs-westerlo-vdqg-bi-2023-344-373997.html"
                                    title="Nhận định - dự đoán Antwerp vs Westerlo 00h15 ngày 24/12 (VĐQG Bỉ 2023/24)"
                                    class="kfb-item-ktv">Nhận định</a></div>
                        </div>
                        <div class="kfb-football-match">
                            <div class="kfb-columns-time"><span class="kfb-time"> 00:15 </span> <span
                                    class="kfb-separator kfb-m-hidden">-</span> <span class="kfb-date">24/12</span> <span
                                    class="kfb-first-round kfb-m-hidden" title="Vòng 19"> 19 </span></div>
                            <div class="kfb-columns-match">
                                <div class="kfb-row-teams">
                                    <div class="kfb-columns-club"><a class="kfb-name-club kfb-club-1"
                                            href="/clubs/royal-antwerp-2635.html" title="Royal Antwerp"> Royal Antwerp
                                            <img class="kfb-logo-club lazyload" alt="Royal Antwerp"
                                                src="https://static.bongda24h.vn/Medias/icon/2022/10/25/royal-antwerp-2510102056.png"
                                                data-src="https://static.bongda24h.vn/Medias/icon/2022/10/25/royal-antwerp-2510102056.png">
                                        </a></div>
                                    <div class="kfb-columns-number">
                                        <p onclick="getMatchinfo(160733)"><span class="kfb-soccer-scores">2 - 2</span></p>
                                    </div>
                                    <div class="kfb-columns-club"><span class="kfb-name-club kfb-club-2"> <img
                                                class="kfb-logo-club lazyload" alt="Westerlo"
                                                src="https://static.bongda24h.vn/Medias/icon/Westerlo_20141014164616.png"
                                                data-src="https://static.bongda24h.vn/Medias/icon/Westerlo_20141014164616.png">
                                            Westerlo </span></div>
                                </div>
                                <div class="kfb-row-match-info"><span class="kfb-item-ktv"><span
                                            title="Tỷ số hiệp 1">H1:</span>
                                        1-0</span></div>
                            </div>
                            <div class="kfb-columns-other">
                                <div class="kfb-flex-right">
                                    <div class="kfb-item-other-1 kfb-m-hidden"><a class="kfb-first-half"
                                            href="/nhan-dinh-bong-da/soi-keo-antwerp-vs-westerlo-vdqg-bi-2023-344-373997.html"
                                            title="Nhận định - dự đoán Antwerp vs Westerlo 00h15 ngày 24/12 (VĐQG Bỉ 2023/24)">NĐ</a>
                                    </div>
                                    <div class="kfb-item-other-2 kfb-m-hidden"></div>
                                    <div class="kfb-item-other-3 f-tv kfb-m-hidden"><span title="Xem kênh">&nbsp;</span>
                                    </div>
                                    <div class="kfb-item-other-4"><a
                                            title="Xem thông tin chi tiết Royal Antwerp vs Westerlo" rel="follow"
                                            class="btn-f-more"
                                            href="/truc-tiep-ket-qua/royal-antwerp-vs-westerlo-160733.html"><i
                                                class="fas fa-chevron-right"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kfb-f-row kfb-match-detail" data-leagueid="21"
                        data="St.Truiden Sporting Charleroi VĐQG Bỉ VĐQG Bỉ VĐQG Bỉ VDQG Bi VDQG Bi VDQG Bi"
                        data-date="24-12">
                        <div class="kfb-row-match">
                            <div class="kfb-right"></div>
                        </div>
                        <div class="kfb-football-match">
                            <div class="kfb-columns-time"><span class="kfb-time"> 00:15 </span> <span
                                    class="kfb-separator kfb-m-hidden">-</span> <span class="kfb-date">24/12</span> <span
                                    class="kfb-first-round kfb-m-hidden" title="Vòng 19"> 19 </span></div>
                            <div class="kfb-columns-match">
                                <div class="kfb-row-teams">
                                    <div class="kfb-columns-club"><a class="kfb-name-club kfb-club-1"
                                            href="/clubs/st-truiden-4338.html" title="St.Truiden"> St.Truiden <img
                                                class="kfb-logo-club lazyload" alt="St.Truiden"
                                                src="https://static.bongda24h.vn/Medias/icon/2023/03/22/sttruiden-2203105708.jpg"
                                                data-src="https://static.bongda24h.vn/Medias/icon/2023/03/22/sttruiden-2203105708.jpg">
                                        </a></div>
                                    <div class="kfb-columns-number">
                                        <p onclick="getMatchinfo(160735)"><span class="kfb-soccer-scores">1 - 0</span></p>
                                    </div>
                                    <div class="kfb-columns-club"><span class="kfb-name-club kfb-club-2"> <img
                                                class="kfb-logo-club lazyload" alt="Sporting Charleroi"
                                                src="https://static.bongda24h.vn/Medias/icon/2023/06/26/sporting-charleroi-2606154637.jpg"
                                                data-src="https://static.bongda24h.vn/Medias/icon/2023/06/26/sporting-charleroi-2606154637.jpg">
                                            Sporting Charleroi </span></div>
                                </div>
                                <div class="kfb-row-match-info"><span class="kfb-item-ktv"><span
                                            title="Tỷ số hiệp 1">H1:</span>
                                        0-0</span></div>
                            </div>
                            <div class="kfb-columns-other">
                                <div class="kfb-flex-right">
                                    <div class="kfb-item-other-1 kfb-m-hidden"></div>
                                    <div class="kfb-item-other-2 kfb-m-hidden"></div>
                                    <div class="kfb-item-other-3 f-tv kfb-m-hidden"><span title="Xem kênh">&nbsp;</span>
                                    </div>
                                    <div class="kfb-item-other-4"><a
                                            title="Xem thông tin chi tiết St.Truiden vs Sporting Charleroi" rel="follow"
                                            class="btn-f-more"
                                            href="/truc-tiep-ket-qua/st.truiden-vs-sporting-charleroi-160735.html"><i
                                                class="fas fa-chevron-right"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kfb-f-row kfb-match-detail" data-leagueid="21"
                        data="Anderlecht Genk VĐQG Bỉ VĐQG Bỉ VĐQG Bỉ VDQG Bi VDQG Bi VDQG Bi" data-date="24-12">
                        <div class="kfb-row-match">
                            <div class="kfb-right"><a
                                    href="/nhan-dinh-bong-da/nhan-dinh-anderlecht-vs-genk-vdqg-bi-344-374013.html"
                                    title="Nhận định bóng đá Anderlecht vs Genk 2h45 ngày 24/12 (VĐQG Bỉ 2023/24)"
                                    class="kfb-item-ktv">Nhận định</a></div>
                        </div>
                        <div class="kfb-football-match">
                            <div class="kfb-columns-time"><span class="kfb-time"> 02:45 </span> <span
                                    class="kfb-separator kfb-m-hidden">-</span> <span class="kfb-date">24/12</span> <span
                                    class="kfb-first-round kfb-m-hidden" title="Vòng 19"> 19 </span></div>
                            <div class="kfb-columns-match">
                                <div class="kfb-row-teams">
                                    <div class="kfb-columns-club"><a class="kfb-name-club kfb-club-1"
                                            href="/clubs/anderlecht-1153.html" title="Anderlecht"> Anderlecht <img
                                                class="kfb-logo-club lazyload" alt="Anderlecht"
                                                src="https://static.bongda24h.vn/Medias/icon/2022/10/20/anderlecht-2010153653.png"
                                                data-src="https://static.bongda24h.vn/Medias/icon/2022/10/20/anderlecht-2010153653.png">
                                        </a></div>
                                    <div class="kfb-columns-number">
                                        <p onclick="getMatchinfo(160728)"><span class="kfb-soccer-scores">2 - 1</span></p>
                                    </div>
                                    <div class="kfb-columns-club"><a class="kfb-name-club kfb-club-2"
                                            href="/clubs/genk-80.html" title="Genk"> Genk <img
                                                class="kfb-logo-club lazyload" alt="Genk"
                                                src="https://static.bongda24h.vn/Medias/icon/2022/10/20/genk-2010154324.png"
                                                data-src="https://static.bongda24h.vn/Medias/icon/2022/10/20/genk-2010154324.png">
                                            <span class="kfb-red-card" title="Thẻ đỏ">2</span> </a></div>
                                </div>
                                <div class="kfb-row-match-info"><span class="kfb-item-ktv"><span
                                            title="Tỷ số hiệp 1">H1:</span>
                                        0-0</span></div>
                            </div>
                            <div class="kfb-columns-other">
                                <div class="kfb-flex-right">
                                    <div class="kfb-item-other-1 kfb-m-hidden"><a class="kfb-first-half"
                                            href="/nhan-dinh-bong-da/nhan-dinh-anderlecht-vs-genk-vdqg-bi-344-374013.html"
                                            title="Nhận định bóng đá Anderlecht vs Genk 2h45 ngày 24/12 (VĐQG Bỉ 2023/24)">NĐ</a>
                                    </div>
                                    <div class="kfb-item-other-2 kfb-m-hidden"></div>
                                    <div class="kfb-item-other-3 f-tv kfb-m-hidden"><span title="Xem kênh">&nbsp;</span>
                                    </div>
                                    <div class="kfb-item-other-4"><a title="Xem thông tin chi tiết Anderlecht vs Genk"
                                            rel="follow" class="btn-f-more"
                                            href="/truc-tiep-ket-qua/anderlecht-vs-genk-160728.html"><i
                                                class="fas fa-chevron-right"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kfb-tabnav-content" style="display:none" id="alertSechdule">
                <div class="match-football">
                    <div class="kfb-football-header" style="background:none">
                        <h3 class="kfb-head-left">Không có trận đấu nào</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
