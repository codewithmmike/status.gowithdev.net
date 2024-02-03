@extends('layout')
@section('content')
    <div class="kfb-section-container">
        @include('schedules.partails.date-list')

        <div class="kfb-table-odds">
            <h2 class="kfb-table-header">Tỉ lệ kèo hôm nay, ngày mai</h2>
            <!-- Search box -->
            <div class="kfb-form-match">
                <div class="kfb-form-match-w">
                    <input class="kfb-search-match" placeholder="Tìm kiếm trận đấu, giải đấu hôm nay, ngày mai">
                    <span class="kfb-btn-search-match">
                        <i class="fa fa-search"></i>
                    </span>
                </div>
            </div>

            <div class="kfb-tabnav-content">
                <!-- League item -->
                <?php for ($i = 0; $i < 3; $i++) :?>
                <div class="kfb-match-football-item">
                    <!-- League header -->
                    <div class="kfb-football-header">
                        <h3 class="kfb-head-left">
                            Lịch thi đấu Premier League
                        </h3>
                        <div class="kfb-head-right">
                            {{-- <a title="Lịch thi đấu Ngoại hạng Anh" href="#"></a> --}}
                            <strong>2 trận</strong>
                        </div>
                    </div>

                    <!-- Match item info -->
                    <?php for ($j = 0; $j < 3; $j++) :?>
                    <div class="kfb-match-detail">
                        <div class="kfb-odds-match <?php echo $j % 2 ? 'kfb-open' : ''; ?>">
                            <div class="kfb-match-title-wrapper">
                                <div class="kfb-col-time">
                                    <span class="kfb-time-title">Thời gian:</span>
                                    <span class="kfb-time"> 00:30 </span>
                                    <span class="kfb-date">24/12</span>
                                </div>

                                <div class="kfb-col-teams">
                                    <div class="kfb-col-club">
                                        <span>Paris Saint Germain</span>
                                        <img loading="lazy" alt="Paris Saint Germain"
                                            src="https://flashcore.net/celta-vigo.png" />
                                    </div>
                                    <div class="kfb-col-number">
                                        <span class="kfb-soccer-scores">vs</span>
                                    </div>
                                    <div class="kfb-col-club">
                                        <img loading="lazy" alt="Atletico Madrid"
                                                src="https://flashcore.net/atletico-madrid.png" />
                                            Atletico Madrid
                                    </div>
                                </div>
                            </div>

                            <div class="kfb-odds-row">
                                <table>
                                    <tr>
                                        <th>Kèo chấp TT</th>
                                        <th>Tài xỉu TT</th>
                                        <th>Thắng TT</th>
                                        <th>Chấp H1</th>
                                        <th>Tài xỉu H1</th>
                                        <th>Thắng H1</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="kfb-odds-top">
                                                <span class="kfb-odds-number kfb-c-red">-0.92</span>
                                                <span class="kfb-odds-number kfb-c-white">0.00</span>
                                                <span class="kfb-odds-number kfb-c-green">0.84</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="kfb-odds-top">
                                                <span class="kfb-odds-number kfb-c-red">-0.92</span>
                                                <span class="kfb-odds-number kfb-c-white">0.00</span>
                                                <span class="kfb-odds-number kfb-c-green">0.84</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="kfb-col-win">
                                                <div>2.73</div>
                                                <div>2.73</div>
                                                <div>2.73</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="kfb-odds-top">
                                                <span class="kfb-odds-number kfb-c-red">-0.92</span>
                                                <span class="kfb-odds-number kfb-c-white">0.00</span>
                                                <span class="kfb-odds-number kfb-c-green">0.84</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="kfb-odds-top">
                                                <span class="kfb-odds-number kfb-c-red">-0.92</span>
                                                <span class="kfb-odds-number kfb-c-white">0.00</span>
                                                <span class="kfb-odds-number kfb-c-green">0.84</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="kfb-col-win">
                                                <div>2.73</div>
                                                <div>2.73</div>
                                                <div>2.73</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="kfb-col-odds-maker">
                                                <button class="kfb-btn-bet">Cược K-Sports</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="kfb-odds-bottom">
                                                <span class="kfb-odds-number kfb-c-red">-0.93</span>
                                                <span class="kfb-odds-number kfb-c-white">0.00</span>
                                                <span class="kfb-odds-number kfb-c-green">0.84</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="kfb-odds-bottom">
                                                <span class="kfb-odds-number kfb-c-red">-0.93</span>
                                                <span class="kfb-odds-number kfb-c-white">0.00</span>
                                                <span class="kfb-odds-number kfb-c-green">0.84</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="kfb-col-win">
                                                <div>2.73</div>
                                                <div>2.73</div>
                                                <div>2.73</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="kfb-odds-bottom">
                                                <span class="kfb-odds-number kfb-c-red">-0.93</span>
                                                <span class="kfb-odds-number kfb-c-white">0.00</span>
                                                <span class="kfb-odds-number kfb-c-green">0.84</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="kfb-odds-bottom">
                                                <span class="kfb-odds-number kfb-c-red">-0.93</span>
                                                <span class="kfb-odds-number kfb-c-white">0.00</span>
                                                <span class="kfb-odds-number kfb-c-green">0.84</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="kfb-col-win">
                                                <div>2.73</div>
                                                <div>2.73</div>
                                                <div>2.73</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="kfb-col-odds-maker">
                                                <button class="kfb-btn-bet kfg-c-sports">Cược C-Sports</button>
                                            </div>
                                        </td>
                                    </tr>
                                </table>

                            </div>

                            <div class="kfb-odds-row-mobile">
                                <table>
                                    <tr>
                                        <td>
                                            <div class="kfb-odds-top">
                                                <span class="kfb-odds-number kfb-c-red">-0.92</span>
                                                <span class="kfb-odds-number kfb-c-white">0.00</span>
                                                <span class="kfb-odds-number kfb-c-green">0.84</span>
                                            </div>
                                        </td>
                                        <td>Chấp</td>
                                        <td>
                                            <div class="kfb-odds-bottom">
                                                <span class="kfb-odds-number kfb-c-red">-0.93</span>
                                                <span class="kfb-odds-number kfb-c-white">0.00</span>
                                                <span class="kfb-odds-number kfb-c-green">0.84</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="kfb-odds-top">
                                                <span class="kfb-odds-number kfb-c-red">-0.92</span>
                                                <span class="kfb-odds-number kfb-c-white">0.00</span>
                                                <span class="kfb-odds-number kfb-c-green">0.84</span>
                                            </div>
                                        </td>
                                        <td>
                                            Tài Xỉu
                                        </td>
                                        <td>
                                            <div class="kfb-odds-bottom">
                                                <span class="kfb-odds-number kfb-c-red">-0.93</span>
                                                <span class="kfb-odds-number kfb-c-white">0.00</span>
                                                <span class="kfb-odds-number kfb-c-green">0.84</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="kfb-odds-top">
                                                <span class="kfb-odds-number">2.73</span>
                                                <span class="kfb-odds-number">2.73</span>
                                                <span class="kfb-odds-number">2.73</span>
                                            </div>
                                        </td>
                                        <td>
                                            Thắng
                                        </td>
                                        <td>
                                            <div class="kfb-odds-bottom">
                                                <span class="kfb-odds-number">2.97</span>
                                                <span class="kfb-odds-number">4.33</span>
                                                <span class="kfb-odds-number">1.96</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="kfb-odds-top">
                                                <span class="kfb-odds-number kfb-c-red">-0.92</span>
                                                <span class="kfb-odds-number kfb-c-white">0.00</span>
                                                <span class="kfb-odds-number kfb-c-green">0.84</span>
                                            </div>
                                        </td>
                                        <td>
                                            Chấp H1
                                        </td>
                                        <td>
                                            <div class="kfb-odds-bottom">
                                                <span class="kfb-odds-number kfb-c-red">-0.93</span>
                                                <span class="kfb-odds-number kfb-c-white">0.00</span>
                                                <span class="kfb-odds-number kfb-c-green">0.84</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="kfb-odds-top">
                                                <span class="kfb-odds-number kfb-c-red">-0.92</span>
                                                <span class="kfb-odds-number kfb-c-white">0.00</span>
                                                <span class="kfb-odds-number kfb-c-green">0.84</span>
                                            </div>
                                        </td>
                                        <td>
                                            Tài Xỉu H1
                                        </td>
                                        <td>
                                            <div class="kfb-odds-bottom">
                                                <span class="kfb-odds-number kfb-c-red">-0.93</span>
                                                <span class="kfb-odds-number kfb-c-white">0.00</span>
                                                <span class="kfb-odds-number kfb-c-green">0.84</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="kfb-odds-bottom">
                                                <span class="kfb-odds-number">2.73</span>
                                                <span class="kfb-odds-number">2.73</span>
                                                <span class="kfb-odds-number">2.73</span>
                                            </div>
                                        </td>
                                        <td>
                                            Thắng H1
                                        </td>
                                        <td>
                                            <div class="kfb-odds-bottom">
                                                <span class="kfb-odds-number">2.97</span>
                                                <span class="kfb-odds-number">4.33</span>
                                                <span class="kfb-odds-number">1.96</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="kfb-col-odds-maker">
                                                <button class="kfb-btn-bet">Cược C-Sports</button>
                                            </div>
                                        </td>

                                        <td>
                                            <a class="btn-detail">
                                                Chi tiết
                                                <img src="/images/icon-arrow-down.svg"
                                                alt="nha-cai-uk88" width="auto" height="auto" class="img-fluid icon-arrow">
                                            </a>
                                        </td>

                                        <td>
                                            <div class="kfb-col-odds-maker">
                                                <button class="kfb-btn-bet kfg-c-sports">Cược C-Sports</button>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
                <?php endfor; ?>
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
