{{content()}}

                        <div class="panel-body">
                            <div class="row">
                            {{ flash.output() }} 
                                <div class="col-lg-4">
                                    <p>
                                        <label for="name">ID do Cliente</label>
                                        {{ text_field("Cliente_id", "size": 32) }}
                                    </p>
                                    </form>
                                </div>
                                <div class="col-lg-4">
                                        {{ form('Products/create', 'method': 'post') }}
                                            <p>
                                                <label for="name">Nome do Cliente</label>
                                                {{ text_field("Cliente_nome", "size": 32) }}
                                            </p>
                                        </form>
                                </div>
                                <div class="col-lg-4">
                                            <p>
                                                <label for="name">Status</label>
                                                {{ text_field("Status", "size": 32) }}
                                            </p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4">
                                    <p>
                                        <h4><label class="label label-default">Valor</label></h4>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <p>
                                                <label for="name">De</label>
                                                {{ text_field("Data_De", "size": 32) }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <p>
                                                    <label for="name">Até</label>
                                                    {{ text_field("Data_ate", "size": 32) }}
                                                </p>
                                            </div>
                                        </div>
                                    </p>
                                </div>
                                <div class="col-lg-4">
                                            <p>
                                                <h4><label class="label label-default">Data</label></h4>
                                            <div class="row">
                                            <div class="col-lg-4">
                                                <p>
                                                <label for="name">De</label>
                                                {{ text_field("Data_De2", "size": 32) }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <p>
                                                    <label for="name">Até</label>
                                                    {{ text_field("Data_ate2", "size": 32) }}
                                                </p>
                                            </div>
                                        </div>
                                    </p>        
                                </div>
                                <div class="col-xs-1">
                                    {{ submit_button('Gerar Informação', 'onclick': 'generateTable()', 'class': 'btn btn-primary') }}
                                </div>
                            </div>
                    </div>
                    <br>
                    <br>
                    <div id="generatedInfo" class="panel panel-default col-lg-10 col-lg-offset-1">
                      <!-- Default panel contents -->
                      <div class="panel-heading">Lista de Submissões</div>

                      <!-- Table -->
                      <div id="table">
                      </div>
                    </div>
                </div>
            </div>
        </div>

                    
                       