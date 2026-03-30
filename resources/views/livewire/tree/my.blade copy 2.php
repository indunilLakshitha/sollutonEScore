<div>

    <div class="tree">
        <ul>
            <li>
                <a href="#" class="card">
                    <div class="card-body">
                        <div class="row-single">
                            <div class="name">{{ $me?->name }}</div>
                        </div>
                        <div class="row-single">
                            <div class="reg"><span>Reg</span>{{ $me?->reg_no }}</div>
                            <div class="status full">{{ $this->getStatus($me?->status) }}</div>
                        </div>
                        <div class="row-single">
                            <div class="half"><span>A1</span>54555</div>
                            <div class="half"><span>A2</span>54555</div>
                        </div>
                        <div class="row-single">
                            <div class="bonus"><span>Bonus</span>54555</div>
                        </div>
                    </div>
                </a>
                <ul>

                    <li>
                        <a href="#" class="card">
                            <div class="card-body">
                                <div class="row-single">
                                    <div class="name">{{ $me?->childA1?->name }}</div>
                                </div>
                                <div class="row-single">
                                    <div class="reg"><span>Reg</span>{{ $me?->childA1?->reg_no }}</div>
                                    <div class="status full">{{ $this->getStatus($me?->childA1?->status) }}</div>
                                </div>
                                <div class="row-single">
                                    <div class="half"><span>A1</span>54555</div>
                                    <div class="half"><span>A2</span>54555</div>
                                </div>
                                <div class="row-single">
                                    <div class="bonus"><span>Bonus</span>54555</div>
                                </div>
                            </div>
                        </a>
                        <ul>
                            <li>
                                <a href="#" class="card">
                                    <div class="card-body">
                                        <div class="row-single">
                                            <div class="name">{{ $me?->childA1?->childA1?->name }}</div>
                                        </div>
                                        <div class="row-single">
                                            <div class="reg"><span>Reg</span>{{ $me?->childA1?->childA1?->reg_no }}
                                            </div>
                                            <div class="status full">
                                                {{ $this->getStatus($me?->childA1?->childA1?->status) }}</div>
                                        </div>
                                        <div class="row-single">
                                            <div class="half"><span>A1</span>54555</div>
                                            <div class="half"><span>A2</span>54555</div>
                                        </div>
                                        <div class="row-single">
                                            <div class="bonus"><span>Bonus</span>54555</div>
                                        </div>
                                    </div>
                                </a>
                                <ul>
                                    <li>
                                        <a href="#" class="less">&nbsp;</a>
                                        <ul>
                                            <li>
                                                <a href="#" class="less">&nbsp;</a>
                                                <ul>
                                                    <li>
                                                        <a href="#" class="less">&nbsp;</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="card">
                                    <div class="card-body">
                                        <div class="row-single">
                                            <div class="name">{{ $me?->childA1?->childA2?->name }}</div>
                                        </div>
                                        <div class="row-single">
                                            <div class="reg"><span>Reg</span>{{ $me?->childA1?->childA2?->reg_no }}
                                            </div>
                                            <div class="status full">
                                                {{ $this->getStatus($me?->childA1?->childA2?->status) }}</div>
                                        </div>
                                        <div class="row-single">
                                            <div class="half"><span>A1</span>54555</div>
                                            <div class="half"><span>A2</span>54555</div>
                                        </div>
                                        <div class="row-single">
                                            <div class="bonus"><span>Bonus</span>54555</div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="card">
                            <div class="card-body">
                                <div class="row-single">
                                    <div class="name">{{ $me?->childA2?->name }}</div>
                                </div>
                                <div class="row-single">
                                    <div class="reg"><span>Reg</span>{{ $me?->childA2?->reg_no }}</div>
                                    <div class="status full">{{ $this->getStatus($me?->childA2?->status) }}</div>
                                </div>
                                <div class="row-single">
                                    <div class="half"><span>A1</span>54555</div>
                                    <div class="half"><span>A2</span>54555</div>
                                </div>
                                <div class="row-single">
                                    <div class="bonus"><span>Bonus</span>54555</div>
                                </div>
                            </div>
                        </a>
                        <ul>
                            <li>
                                <a href="#" class="less">&nbsp;</a>
                                <ul>
                                    <li>
                                        <a href="#" class="less">&nbsp;</a>
                                    </li>
                                    <li>
                                        <a href="#" class="less">&nbsp;</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="less">&nbsp;</a>
                                <ul>
                                    <li>
                                        <a href="#" class="less">&nbsp;</a>
                                    </li>
                                    <li>
                                        <a href="#" class="less">&nbsp;</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <style>
        /* ****************** */
        /******* Reset ********/
        /* ****************** */
        * {
            margin: 0;
            padding: 0;
        }

        /* ****************** */
        /***** Tree Area ******/
        /* ****************** */
        .tree ul {
            padding-top: 20px;
            position: relative;
            transition: all 0.5s;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
            display: flex;
            justify-content: center;
        }

        .tree li {
            float: left;
            text-align: center;
            list-style-type: none;
            position: relative;
            padding: 20px 5px 0 5px;

            transition: all 0.5s;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
        }

        .tree li::before,
        .tree li::after {
            content: '';
            position: absolute;
            top: 0;
            right: 50%;
            border-top: 1px solid #ccc;
            width: 50%;
            height: 20px;
        }

        .tree li::after {
            right: auto;
            left: 50%;
            border-left: 1px solid #ccc;
        }

        .tree li:only-child::after,
        .tree li:only-child::before {
            display: none;
        }

        .tree li:only-child {
            padding-top: 0;
        }

        .tree li:first-child::before,
        .tree li:last-child::after {
            border: 0 none;
        }

        .tree li:last-child::before {
            border-right: 1px solid #ccc;
            border-radius: 0 5px 0 0;
            -webkit-border-radius: 0 5px 0 0;
            -moz-border-radius: 0 5px 0 0;
        }

        .tree li:first-child::after {
            border-radius: 5px 0 0 0;
            -webkit-border-radius: 5px 0 0 0;
            -moz-border-radius: 5px 0 0 0;
        }

        .tree ul ul::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            border-left: 1px solid #ccc;
            width: 0;
            height: 20px;
        }

        .tree li a {
            border: 1px solid #ccc;
            padding: 10px 10px;
            color: #666;
            font-size: 11px;
            text-decoration: none;
            display: inline-block;
            border-radius: 10px;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            transition: all 0.5s;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
        }

        .tree li a.less {
            padding: 5px 12px;
            border-radius: 50px;
            background-color: #2C5B88;
            border-color: #2C5B88;
        }

        .tree li a:hover,
        .tree li a:hover+ul li a {
            color: #000;
            background: #c8e4f8;
        }

        .tree li a.btn:hover,
        .tree li a.btn:hover+ul li a {
            color: #000;
            background: #c8e4f8;
            border: 1px solid #94a0b4;
        }

        .tree li a:hover+ul li::after,
        .tree li a:hover+ul li::before,
        .tree li a:hover+ul::before,
        .tree li a:hover+ul ul::before {
            border-color: #94a0b4;
        }

        /* ****************** */
        /* Card component CSS */
        /* ****************** */
        ul {
            padding-left: 0;
        }

        .card {
            font-family: "Inter", sans-serif;
            font-size: 12px;
            font-weight: 400;
            width: 160px;
            padding: 8px;
            background-color: #eee;
            border: 1px solid rgb(0, 0, 0, 0.12);
            border-radius: 10px;
            text-align: left;
        }

        .card .card-body {
            padding: 0;
            display: flex;
            flex-direction: column;
            row-gap: 7px;
        }

        .card .card-body .row-single {
            display: flex;
            justify-content: space-between;
            column-gap: 7px;
            overflow: hidden;
        }

        .card .card-body .row-single .name {
            width: 100%;
            background-color: #003263;
            border-radius: 7px;
            font-size: 12.5px;
            font-weight: 600;
            color: #fff;
            text-align: center;
            padding: 1px 4px 1px 4px;
        }

        .card .card-body .row-single .reg {
            border-radius: 6px;
            background-color: #fff;
            width: 100%;
            padding: 1px 3px 1px 6px;
        }

        .card .card-body .row-single .reg span {
            font-weight: 500;
            margin: 0 4px 0 0;
        }

        .card .card-body .row-single .status {
            min-width: 42px;
            max-width: 42px;
            border-radius: 6px;
            background-color: #fff;
            font-size: 11.5px;
            text-align: center;
            color: #fff;
            text-transform: uppercase;
            padding: 1px 3px 0px 3px;
        }

        .card .card-body .row-single .status.full {
            background-color: #308EE0;
        }

        .card .card-body .row-single .status.half {
            background-color: #8862E0;
        }

        .card .card-body .row-single .status.er {
            background-color: #00CE68;
        }

        .card .card-body .row-single .half {
            width: 50%;
            border-radius: 6px;
            background-color: #fff;
            padding: 1px 3px 1px 6px;
        }

        .card .card-body .row-single .half span {
            font-weight: 500;
            margin: 0 3px 0 0;
        }

        .card .card-body .row-single .bonus {
            width: 100%;
            border-radius: 6px;
            background-color: #fff;
            padding: 1px 3px 1px 6px;
        }

        .card .card-body .row-single .bonus span {
            font-weight: 500;
            margin: 0 3px 0 0;
        }
    </style>
</div>
