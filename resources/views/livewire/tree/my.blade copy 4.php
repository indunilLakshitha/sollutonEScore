<div>

    <div class="tree" id="tree_div">
        <ul class="top_ul">
            <li>
                <a href="#" class="card" id="center_parent">
                    <div class="card-body">
                        <div class="row-single">
                            <div class="name">{{ $me?->name }}</div>
                        </div>
                        <div class="row-single">
                            <div class="reg"><span>Reg</span>{{ $me?->reg_no }}</div>
                            <div class="status full">{{ $this->getStatus($me?->er_status) }}</div>
                        </div>
                        <div class="row-single">
                            <div class="half"><span>A1</span>{{ $me?->left_points }}</div>
                            <div class="half"><span>A2</span>{{ $me?->right_points }}</div>
                        </div>
                        <div class="row-single">
                            <div class="bonus"><span>Bonus</span>0</div>
                        </div>
                    </div>
                </a>
                @if (isset($me->childA1) || isset($me->childA2))
                    <ul>
                        @if (isset($me->childA1))
                            <li>
                                <a href="#" class="card">
                                    <div class="card-body">
                                        <div class="row-single">
                                            <div class="name">{{ $me?->childA1?->name }}</div>
                                        </div>
                                        <div class="row-single">
                                            <div class="reg"><span>Reg</span>{{ $me?->childA1?->reg_no }}</div>
                                            <div class="status full">{{ $this->getStatus($me?->childA1?->er_status) }}
                                            </div>
                                        </div>
                                        <div class="row-single">
                                            <div class="half"><span>A1</span>{{ $me?->childA1?->left_points }}</div>
                                            <div class="half"><span>A2</span>{{ $me?->childA1?->right_points }}</div>
                                        </div>
                                        <div class="row-single">
                                            <div class="bonus"><span>Bonus</span>0</div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="d-none" id="{{ $me->childA1->reg_no }}">
                                    <li class="d-none " id="{{ $me->childA1->reg_no . 'A1' }}"></li>
                                    <li class="d-none " id="{{ $me->childA1->reg_no . 'A2' }}"></li>
                                </ul>
                            </li>
                        @endif
                        @if (isset($me->childA2))
                            <li>
                                <a href="#" class="card">
                                    <div class="card-body">
                                        <div class="row-single">
                                            <div class="name">{{ $me?->childA2?->name }}</div>
                                        </div>
                                        <div class="row-single">
                                            <div class="reg"><span>Reg</span>{{ $me?->childA2?->reg_no }}</div>
                                            <div class="status full">{{ $this->getStatus($me?->childA2?->er_status) }}
                                            </div>
                                        </div>
                                        <div class="row-single">
                                            <div class="half"><span>A1</span>{{ $me?->childA2?->left_points }}</div>
                                            <div class="half"><span>A2</span>{{ $me?->childA2?->right_points }}</div>
                                        </div>
                                        <div class="row-single">
                                            <div class="bonus"><span>Bonus</span>0</div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="d-none" id="{{ $me->childA2->reg_no }}">
                                    <li class="d-none " id="{{ $me->childA2->reg_no . 'A1' }}"></li>
                                    <li class="d-none " id="{{ $me->childA2->reg_no . 'A2' }}"></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                @endif

            </li>
        </ul>
    </div>
    <style>
        .edash-page-container {
            max-width: 100%;
            overflow: scroll;
            justify-content: center !important;
            justify-items: center;
            flex-direction: column;
            align-items: center;

        }

        .tree {
            max-height: 720px !important;
            /* max-width: 1130px; */


        }

        /* .top_ul {
            justify-content: center !important;
            justify-items: center;
        } */



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
            overflow-x: scroll;
            width: fit-content;
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

        .tree li.single:first-child::after {
            border-top: none;
            border-radius: 0;
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

<script>
    let members;
    let added_parents = [];
    window.onload = function() {
        setTree({!! json_encode($myTeam ?? [], JSON_HEX_TAG) !!});
        changeWidth();

    };
    window.addEventListener('resize', changeWidth);

    function changeWidth() {
        var style = document.createElement('style');
        style.type = 'text/css';
        var width = window.innerWidth - 300;
        var width_value = width + "px";
        document.getElementById('tree_div').style.maxWidth = width_value;
    }

    let notAppend = [];
    let added = [];

    function setTree(nodes) {
        let data = nodes
        members = data;
        var rounds = 1;
        data.forEach(element => {
            var parent = element.parent_id;

            var parent_ul = document.getElementById(parent + element.assigned_user_side);
            var main_parent_ul = document.getElementById(parent);

            if (parent_ul == null) {
                notAppend.push(element);
            }
            if (parent_ul) {
                main_parent_ul.className -= "d-none";
                parent_ul.className -= "d-none";
                parent_ul.className += " single";
                added_parents.push(element.parent_id);
                if (rounds > 3) {
                    // addBallToTree(element, parent_ul);
                    addToTreeWithBalls(element, parent_ul);
                } else {

                    addToTree(element, parent_ul);
                }
                added.push(element.id);
                added.push(element.child_a1.id);
                added.push(element.child_a2.id);
            }
            rounds++;
        });

        if (notAppend.length > 0) {
            notAppend.forEach(e => {
                if (added.includes(e.parent_id)) {
                    var parent_ul = document.getElementById(e.parent_id + e.assigned_user_side);
                    var main_parent_ul = document.getElementById(e.parent_id);

                    main_parent_ul.className -= "d-none";
                    parent_ul.className -= "d-none";
                    parent_ul.className += " single";

                    addToTree(e, parent_ul);


                }
            });
        }

        unsetSingleForDuplicates();
    }

    function unsetSingleForDuplicates() {
        const duplicates = added_parents.filter((item, index) => added_parents.indexOf(item) !== index);

        duplicates.forEach(e => {
            document.getElementById(e + 'A1').className -= "single";
            document.getElementById(e + 'A2').className -= "single";

        })


    }


    function addToTree(data, paremt_element) {
        var element = data;
        var node = `
                        <a href="#" class="card">
                            <div class="card-body">
                                <div class="row-single">
                                    <div class="name">${element.name}</div>
                                </div>
                                <div class="row-single">
                                    <div class="reg"><span>Reg</span>${element.reg_no}</div>
                                    <div class="status full">
                                        ${getStatus(element.er_status)}
                                    </div>
                                </div>
                                <div class="row-single">
                                    <div class="half"><span>A1</span>${element.left_points}</div>
                                    <div class="half"><span>A2</span>${element.right_points}</div>
                                </div>
                                <div class="row-single">
                                    <div class="bonus"><span>Bonus</span>0</div>
                                </div>
                            </div>
                        </a>
                        <ul>
                            <li class='d-none'>
                                <a href="#" class="card">
                                    <div class="card-body">
                                        <div class="row-single">
                                            <div class="name">${element.child_a1.name}</div>
                                        </div>
                                        <div class="row-single">
                                            <div class="reg"><span>Reg</span>${element.child_a1.reg_no}</div>
                                            <div class="status full">${getStatus(element.child_a1.er_status)}</div>
                                        </div>
                                        <div class="row-single">
                                            <div class="half"><span>A1</span>${element.child_a1.left_points}</div>
                                            <div class="half"><span>A2</span>${element.child_a1.right_points}</div>
                                        </div>
                                        <div class="row-single">
                                            <div class="bonus"><span>Bonus</span>0</div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="d-none" id="${element.child_a1.reg_no}">
                                     <li class="d-none single"  id="${element.child_a1.reg_no+'A1'}"></li>
                                     <li class="d-none single"  id="${element.child_a1.reg_no+'A2'}"></li>

                                     </ul>
                            </li>
                            <li class='d-none'>
                                <a href="#" class="card">
                                    <div class="card-body">
                                        <div class="row-single">
                                            <div class="name">${element.child_a2.name}</div>
                                        </div>
                                        <div class="row-single">
                                            <div class="reg"><span>Reg</span>${element.child_a2.reg_no}</div>
                                            <div class="status full">${getStatus(element.child_a2.er_status)}</div>
                                        </div>
                                        <div class="row-single">
                                            <div class="half"><span>A1</span>${element.child_a2.left_points}</div>
                                            <div class="half"><span>A2</span>${element.child_a2.right_points}</div>
                                        </div>
                                        <div class="row-single">
                                            <div class="bonus"><span>Bonus</span>0</div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="d-none" id="${element.child_a2.reg_no}">
                                    <li class="d-none single"  id="${element.child_a2.reg_no+'A1'}"></li>
                                     <li class="d-none single"  id="${element.child_a2.reg_no+'A2'}"></li>
                                </ul>
                            </li>
                        </ul>

                    `;

        paremt_element.innerHTML += node;
    }

    function addToTreeWithBalls(data, paremt_element) {
        var element = data;
        var node = `
                         <a @click="showCard(${element.id})" class="less" id="${element.id+'ball_one'}">&nbsp;</a>
                        <ul>
                            <li>
                                 <a @click="showCard(${element.id})" class="less" id="${element.id+'ball_two'}">&nbsp;</a>
                                </a>
                                <ul class="d-none" id="${element.child_a1.reg_no}">
                                     <li class="d-none single"  id="${element.child_a1.reg_no+'A1'}"></li>
                                     <li class="d-none single"  id="${element.child_a1.reg_no+'A2'}"></li>

                                     </ul>
                            </li>
                            <li>
                                 <a @click="showCard(${element.id})" class="less"  id="${element.id+'ball_three'}">&nbsp;</a>
                                <ul class="d-none" id="${element.child_a2.reg_no}">
                                    <li class="d-none single"  id="${element.child_a2.reg_no+'A1'}"></li>
                                     <li class="d-none single"  id="${element.child_a2.reg_no+'A2'}"></li>
                                </ul>
                            </li>
                        </ul>

                    `;

        paremt_element.innerHTML += node;
    }
    var showed = [];

    function showCard(id) {
        var child_one, child_two;
        members.forEach(element => {
            if (element.id == id) {
                if (!showed.includes(id)) {


                    child_one = element.child_a1.id;
                    child_two = element.child_a2.id;

                    showed.push(element.id);

                    var paremt_element = document.getElementById(element.id + 'ball_one');
                    showMainBall(element, paremt_element);

                    var paremt_element = document.getElementById(element.id + 'ball_two');
                    showLeftBall(element, paremt_element);

                    var paremt_element = document.getElementById(element.id + 'ball_three');
                    showRightBall(element, paremt_element);
                }

            }
        })

        members.forEach(element => {
            if (element.parent_id == child_one) {
                if (!showed.includes(child_one)) {


                    showed.push(element.id);
                    var paremt_element = document.getElementById(element.id + 'ball_one');
                    showMainBall(element, paremt_element);

                    var paremt_element = document.getElementById(element.id + 'ball_two');
                    showLeftBall(element, paremt_element);

                    var paremt_element = document.getElementById(element.id + 'ball_three');
                    showRightBall(element, paremt_element);
                }

            }
        })

        members.forEach(element => {
            if (element.parent_id == child_two) {
                if (!showed.includes(idchild_two)) {


                    showed.push(element.id);
                    var paremt_element = document.getElementById(element.id + 'ball_one');
                    showMainBall(element, paremt_element);

                    var paremt_element = document.getElementById(element.id + 'ball_two');
                    showLeftBall(element, paremt_element);

                    var paremt_element = document.getElementById(element.id + 'ball_three');
                    showRightBall(element, paremt_element);
                }

            }
        })

    }

    function showMainBall(element, paremt_element) {
        var node = `
                        <div class="card-body">
                            <div class="row-single">
                                <div class="name">${element.name}</div>
                            </div>
                            <div class="row-single">
                                <div class="reg"><span>Reg</span>${element.reg_no}</div>
                                <div class="status full">
                                    ${getStatus(element.er_status)}
                                </div>
                            </div>
                            <div class="row-single">
                                <div class="half"><span>A1</span>${element.left_points}</div>
                                <div class="half"><span>A2</span>${element.right_points}</div>
                            </div>
                            <div class="row-single">
                                <div class="bonus"><span>Bonus</span>0</div>
                            </div>
                        </div>
                        `;

        paremt_element.innerHTML = node;
        paremt_element.className -= "less";
        paremt_element.className += " card";
    }

    function showLeftBall(element, paremt_element) {
        var node = `
                            <div class="card-body">
                                <div class="row-single">
                                    <div class="name">${element.child_a1.name}</div>
                                </div>
                                <div class="row-single">
                                    <div class="reg"><span>Reg</span>${element.child_a1.reg_no}</div>
                                    <div class="status full">${getStatus(element.child_a1.er_status)}</div>
                                </div>
                                <div class="row-single">
                                    <div class="half"><span>A1</span>${element.child_a1.left_points}</div>
                                    <div class="half"><span>A2</span>${element.child_a1.right_points}</div>
                                </div>
                                <div class="row-single">
                                    <div class="bonus"><span>Bonus</span>0</div>
                                </div>
                            </div>
                    `;

        paremt_element.innerHTML = node;
        paremt_element.className -= "less";
        paremt_element.className += " card";
    }

    function showRightBall(element, paremt_element) {
        var node = `
                            <div class="card-body">
                                <div class="row-single">
                                    <div class="name">${element.child_a2.name}</div>
                                </div>
                                <div class="row-single">
                                    <div class="reg"><span>Reg</span>${element.child_a2.reg_no}</div>
                                    <div class="status full">${getStatus(element.child_a2.er_status)}</div>
                                </div>
                                <div class="row-single">
                                    <div class="half"><span>A1</span>${element.child_a2.left_points}</div>
                                    <div class="half"><span>A2</span>${element.child_a2.right_points}</div>
                                </div>
                                <div class="row-single">
                                    <div class="bonus"><span>Bonus</span>0</div>
                                </div>
                            </div>
                    `;

        paremt_element.innerHTML = node;
        paremt_element.className -= "less";
        paremt_element.className += " card";
    }


    function getStatus(status) {
        if (status == 1) {
            return 'NONE';
        }
        if (status == 2) {
            return 'HALF';
        }
        if (status == 3) {
            return 'FULL';
        }
        if (status == 4) {
            return 'ER';
        }

    }



    function removeBallFromTree(data, paremt_element) {
        var element = data;
        var node = `
                         <a @click="showCard(${element.id})" class="less">&nbsp;</a>
                        <ul>
                            <li>
                                 <a @click="showCard(${element.id})" class="less">&nbsp;</a>
                                </a>
                                <ul class="d-none" id="${element.child_a1.reg_no}">
                                     <li class="d-none single"  id="${element.child_a1.reg_no+'A1'}"></li>
                                     <li class="d-none single"  id="${element.child_a1.reg_no+'A2'}"></li>

                                     </ul>
                            </li>
                            <li>
                                 <a @click="showCard(${element.id})" class="less">&nbsp;</a>
                                <ul class="d-none" id="${element.child_a2.reg_no}">
                                    <li class="d-none single"  id="${element.child_a2.reg_no+'A1'}"></li>
                                     <li class="d-none single"  id="${element.child_a2.reg_no+'A2'}"></li>
                                </ul>
                            </li>
                        </ul>

                    `;

        paremt_element.innerHTML -= node;
    }
</script>
