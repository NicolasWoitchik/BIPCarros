<div class="m-portlet">
    <div class="m-portlet__body  m-portlet__body--no-padding">
        <div class="row m-row--no-padding m-row--col-separator-xl">
            <div class="col-xl-4">
                <div class="m-widget1">
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">
                                    Total de interações no Twitter
                                </h3>
                                <span class="m-widget1__desc">
                                    Valor referente até a data de atualização
                                </span>
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-success">
                                    3000
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">
                                    Total de interações no Twitter com a Hashtag #FiatArgo
                                </h3>
                                <span class="m-widget1__desc">
                                    Valor referente até a data de atualização
                                </span>
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-danger">
                                    560
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="m-widget14">
                    <div class="m-widget14__header m--margin-bottom-30">
                        <h3 class="m-widget14__title">
                            Total de interações nos ultimos 30 dias
                        </h3>
                        <span class="m-widget14__desc">
                        </span>
                    </div>
                    <div class="m-widget14__chart" style="height:120px;">
                        <canvas  id="m_chart_daily_sales"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="m-widget14">
                    <div class="m-widget14__header">
                        <h3 class="m-widget14__title">
                            Tipos de interaões
                        </h3>
                        <span class="m-widget14__desc">
                            Dados analizados por <a href="https://www.ibm.com/watson/services/tone-analyzer/">Tone Analyzer</a>
                        </span>
                    </div>
                    <div class="row  align-items-center">
                        <div class="col">
                            <div id="m_chart_profit_share" class="m-widget14__chart" style="height: 160px">
                                <div class="m-widget14__stat">
                                    200
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="m-widget14__legends">
                                <div class="m-widget14__legend">
                                    <span class="m-widget14__legend-bullet m--bg-accent"></span>
                                    <span class="m-widget14__legend-text">
                                        37% Com Raiva.
                                    </span>
                                </div>
                                <div class="m-widget14__legend">
                                    <span class="m-widget14__legend-bullet m--bg-warning"></span>
                                    <span class="m-widget14__legend-text">
                                        47% Medo
                                    </span>
                                </div>
                                <div class="m-widget14__legend">
                                    <span class="m-widget14__legend-bullet m--bg-fill-danger"></span>
                                    <span class="m-widget14__legend-text">
                                        19% Alegria
                                    </span>
                                </div>
                                <div class="m-widget14__legend">
                                    <span class="m-widget14__legend-bullet m--bg-brand"></span>
                                    <span class="m-widget14__legend-text">
                                        19% Tristeza
                                    </span>
                                </div>
                                <div class="m-widget14__legend">
                                    <span class="m-widget14__legend-bullet m--bg-brand"></span>
                                    <span class="m-widget14__legend-text">
                                        19% Analítico
                                    </span>
                                </div>
                                <div class="m-widget14__legend">
                                    <span class="m-widget14__legend-bullet m--bg-brand"></span>
                                    <span class="m-widget14__legend-text">
                                        19% Confiante
                                    </span>
                                </div>
                                <div class="m-widget14__legend">
                                    <span class="m-widget14__legend-bullet m--bg-brand"></span>
                                    <span class="m-widget14__legend-text">
                                        19% Hesitante
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if ( isset($filtro) ) : echo $filtro; endif; ?>
<div class="row">
    <div class="paginacao col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php if (isset($paginacao)) : echo $paginacao; endif; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-scrollable">
            <?php echo (isset($listagem) ? $listagem : '');?>
        </div>
    </div>
    <div class="paginacao col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php if (isset($paginacao)) : echo $paginacao; endif; ?>
            </div>
        </div>
    </div>
</div>