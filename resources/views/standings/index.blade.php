@extends('layout')
@section('content')
    <div class="kfb-section-container" id="ltd_kq_byleague'">
        <div class="kfb-table-wrapper">
            <div class="kfb-section-title">
                <h2 class="kfb-title-league">
                    <a title="BXH Ngoại hạng Anh" href="#">
                        BXH Ngoại hạng Anh (Vòng 16)
                    </a>
                </h2>
                <select id="ddlSeason" class="kfb-select-minimal" onchange="ChangeFootBallSeason(this.value)">
                    <option value="15" selected="">Mùa 2023-2024</option>
                    <option value="14">Mùa 2022-2023</option>
                    <option value="13">Mùa 2021-2022</option>
                    <option value="12">Mùa 2020-2021</option>
                    <option value="11">Mùa 2019-2020</option>
                    <option value="10">Mùa 2018-2019</option>
                    <option value="7">Mùa 2017-2018</option>
                    <option value="6">Mùa 2016-2017</option>
                    <option value="5">Mùa 2015-2016</option>
                    <option value="4">Mùa 2014-2015</option>
                    <option value="3">Mùa 2013-2014</option>
                    <option value="2">Mùa 2012-2013</option>
                    <option value="1">Mùa 2011-2012</option>
                </select>
            </div>

            <div class="kfb-link-group">
                <div class="kfb-link-group-inner">
                    <a title="Lịch thi đấu Ngoại hạng Anh" href="#">Lịch thi đấu Ngoại hạng Anh</a>
                    <a title="KQBD Ngoại hạng Anh" href="#">KQBD Ngoại hạng Anh</a>
                </div>
            </div>
            <div class="kfb-guideline">Th: thắng | H: hòa | B: bại | HS: hiệu số | Đ: điểm</div>
            @include('standings.partials.table-scroll')
            <div class="kfb-more-club">
                <a title="BXH Premier League" href="/bong-da-anh/bang-xep-hang-1.html">Xem tiếp</a>
            </div>
        </div>

        <div class="kfb-table-wrapper">
            <div class="kfb-section-title">
                <h2 class="kfb-title-league">
                    <a title="BXH Cúp C1 (Mùa 2023/2024)" href="#">
                        BXH Cúp C1 (Mùa 2023/2024)
                    </a>
                </h2>
                <select id="ddlSeason" class="kfb-select-minimal" onchange="ChangeFootBallSeason(this.value)">
                    <option value="15" selected="">Mùa 2023-2024</option>
                    <option value="14">Mùa 2022-2023</option>
                    <option value="13">Mùa 2021-2022</option>
                    <option value="12">Mùa 2020-2021</option>
                    <option value="11">Mùa 2019-2020</option>
                    <option value="10">Mùa 2018-2019</option>
                    <option value="7">Mùa 2017-2018</option>
                    <option value="6">Mùa 2016-2017</option>
                    <option value="5">Mùa 2015-2016</option>
                    <option value="4">Mùa 2014-2015</option>
                    <option value="3">Mùa 2013-2014</option>
                    <option value="2">Mùa 2012-2013</option>
                    <option value="1">Mùa 2011-2012</option>
                </select>
            </div>

            <div class="kfb-link-group">
                <div class="kfb-link-group-inner">
                    <a title="Lịch thi đấu Ngoại hạng Anh" href="#">Lịch thi đấu Cup C1</a>
                    <a title="KQBD Ngoại hạng Anh" href="#">KQBD Cup C1</a>
                </div>
            </div>
            <div class="kfb-guideline">Th: thắng | H: hòa | B: bại | HS: hiệu số | Đ: điểm</div>

            @include('standings.partials.table-scroll-group')
            @include('standings.partials.table-scroll-group')
            @include('standings.partials.table-scroll-group')

            <div class="kfb-note">
                <ul>
                    <li><span class="kfb-bg-color kfb-bg-green">T</span> Thắng</li>
                    <li><span class="kfb-bg-color kfb-bg-yelow">H</span> Hòa</li>
                    <li><span class="kfb-bg-color kfb-bg-red">B</span> Bại</li>
                </ul>
            </div>

            <div class="kfb-more-club">
                <a title="BXH Premier League" href="/bong-da-anh/bang-xep-hang-1.html">Xem tiếp</a>
            </div>
        </div>

    </div>
@endsection
