@extends('layouts.app')

@section('content')
@php
$userEncoded = base64_encode($user);
@endphp
<main class="home">

    <x-header-herramientas class="py-5 titulo"
        background="background-image: url({{ asset('storage/img/home/home.jpg')}})"
        title="Bombas SACI para piscinas públicas"
        description="Aquí dispones de una tabla con todos las bombas de SACI para piscina pública" :user="$user" />

    <style>
        table {
            width: 100%;
            margin: 0 auto;
            border-collapse: collapse;
        }

        th {
            background-color: var(--azulosc);
            /* Cambia este color según tu preferencia */
            color: white;
            padding: 2px;
            text-align: center;
            width: 150px;
            border: 1px solid white;
        }

        td {
            padding: 1px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .vertical-text {
            writing-mode: vertical-rl;
            text-orientation: mixed;
        }

        a {
            text-decoration: inherit;
        }
    </style>

    <div class="py-5 album bg-light">
        <div class="container">
            <div>
                <table class="min-w-full mb-2 bg-white">
                    <thead>
                        <tr>
                            <th rowspan="2">TIPO</th>
                            <th rowspan="2">NOMBRE</th>
                            <th rowspan="2">MODELO</th>
                            <th rowspan="2">HP</th>
                            <th rowspan="2">KW</th>
                            <th colspan="2">Amp.</th>
                            <th colspan="9">Altura manométrica m.c.a./caudal m³/h</th>
                            <th>conex.</th>
                            <th rowspan="2">Ø Min. Asp.</th>
                            <th rowspan="2">Enlace</th>
                        </tr>
                        <tr>
                            <th>230V</th>
                            <th>400V</th>
                            <th>6</th>
                            <th>8</th>
                            <th>10</th>
                            <th>12</th>
                            <th>14</th>
                            <th>16</th>
                            <th>18</th>
                            <th>20</th>
                            <th>22</th>
                            <th>DNA DNI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="vertical-text" rowspan="19">AUTOASPIRANTE</td>
                            <td rowspan="4">SUPRA</td>
                            <td>300 M</td>
                            <td rowspan="2">3</td>
                            <td rowspan="2">2,2</td>
                            <td rowspan="2">16,4</td>
                            <td rowspan="2">5,3</td>
                            <td rowspan="2">59</td>
                            <td rowspan="2">54</td>
                            <td rowspan="2">47</td>
                            <td rowspan="2">39</td>
                            <td rowspan="2">28</td>
                            <td rowspan="2">16</td>
                            <td rowspan="2">-</td>
                            <td rowspan="2">-</td>
                            <td rowspan="2">-</td>
                            <td rowspan="4">3" Ø 90 PVC</td>
                            <td rowspan="4">Ø 90</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/231-1631-supra-840025197759.html#/1687-potencia_cv_-30_cv/1693-corriente-monofasica/1694-modelo-300_22_kw_30_cv_230v_39_m_h_12_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>300 T</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/231-1628-supra-840025197759.html#/1686-corriente-trifasica/1687-potencia_cv_-30_cv/1688-modelo-300_22_kw_30_cv_400v_39_m_h_12_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>400 </td>
                            <td>4</td>
                            <td>3</td>
                            <td>12,5</td>
                            <td>6,9</td>
                            <td>68</td>
                            <td>63</td>
                            <td>58</td>
                            <td>52</td>
                            <td>45</td>
                            <td>36</td>
                            <td>23</td>
                            <td>-</td>
                            <td>-</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/231-1629-supra-840025197759.html#/1686-corriente-trifasica/1689-potencia_cv_-40_cv/1690-modelo-400_30_kw_40_cv_400v_52_m_h_12_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>550 </td>
                            <td>5,5</td>
                            <td>4</td>
                            <td>-</td>
                            <td>8,8</td>
                            <td>78</td>
                            <td>74</td>
                            <td>70</td>
                            <td>65</td>
                            <td>59</td>
                            <td>50</td>
                            <td>39</td>
                            <td>-</td>
                            <td>-</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/231-1630-supra-840025197759.html#/1686-corriente-trifasica/1691-potencia_cv_-55_cv/1692-modelo-550_40_kw_55_cv_400v_65_m_h_12_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td rowspan="8">MAGNUS</td>
                            <td>4-250</td>
                            <td>2,5</td>
                            <td>1,8</td>
                            <td>8,5</td>
                            <td>4,9</td>
                            <td>53</td>
                            <td>43</td>
                            <td>32</td>
                            <td>18</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td rowspan="15">Ø ASP/IMP 110</td>
                            <td>110</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/443-1775-magnus-trifasica.html#/1862-potencia_cv_-25_cv/1863-modelo-250_18_kw_25_cv_230_400v_18_m_h_12_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>4-300</td>
                            <td>3</td>
                            <td>2,2</td>
                            <td>9,4</td>
                            <td>5,3</td>
                            <td>62</td>
                            <td>54</td>
                            <td>43</td>
                            <td>26</td>
                            <td>10</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>125</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/443-1776-magnus-trifasica.html#/1687-potencia_cv_-30_cv/1864-modelo-300_22_kw_30_cv_230_400v_26_m_h_12_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>4-400</td>
                            <td>4</td>
                            <td>3</td>
                            <td>12,5</td>
                            <td>6,9</td>
                            <td>74</td>
                            <td>66</td>
                            <td>56</td>
                            <td>42</td>
                            <td>29</td>
                            <td>14</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>140</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/443-1777-magnus-trifasica.html#/1689-potencia_cv_-40_cv/1865-modelo-400_30_kw_40_cv_230_400v_42_m_h_12_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>4-550</td>
                            <td>5,5</td>
                            <td>4</td>
                            <td>15,3</td>
                            <td>8,8</td>
                            <td>123</td>
                            <td>104</td>
                            <td>84</td>
                            <td>57</td>
                            <td>30</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>160</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/443-1778-magnus-trifasica.html#/1691-potencia_cv_-55_cv/1866-modelo-550_40_kw_55_cv_230_400v_57_m_h_12_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>4-750</td>
                            <td>7,5</td>
                            <td>5,5</td>
                            <td rowspan="4">-</td>
                            <td>12</td>
                            <td>143</td>
                            <td>127</td>
                            <td>107</td>
                            <td>85</td>
                            <td>57</td>
                            <td>12</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>180</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/443-1779-magnus-trifasica.html#/1867-potencia_cv_-75_cv/1868-modelo-750_55_kw_75_cv_400_690v_85_m_h_12_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>4-1000</td>
                            <td>10</td>
                            <td>7,5</td>
                            <td>15,8</td>
                            <td>160</td>
                            <td>145</td>
                            <td>126</td>
                            <td>107</td>
                            <td>80</td>
                            <td>48</td>
                            <td>14</td>
                            <td>-</td>
                            <td>-</td>
                            <td>180</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/443-1780-magnus-trifasica.html#/1869-potencia_cv_-100_cv/1870-modelo-1000_75_kw_100_cv_400_690v_107_m_h_12_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>2-1250</td>
                            <td>12,5</td>
                            <td>9,2</td>
                            <td>18,5</td>
                            <td rowspan="2">-</td>
                            <td>167</td>
                            <td>152</td>
                            <td>136</td>
                            <td>118</td>
                            <td>99</td>
                            <td>80</td>
                            <td>47</td>
                            <td>-</td>
                            <td>180</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/443-1781-magnus-trifasica.html#/1871-potencia_cv_-125_cv/1872-modelo-1250_94_kw_125_cv_400_690v_136_m_h_12_mca_turbina_bronce"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>2-1500</td>
                            <td>15</td>
                            <td>11</td>
                            <td>20,9</td>
                            <td>188</td>
                            <td>177</td>
                            <td>162</td>
                            <td>146</td>
                            <td>130</td>
                            <td>112</td>
                            <td>92</td>
                            <td>66</td>
                            <td>200</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/443-1782-magnus-trifasica.html#/1873-potencia_cv_-150_cv/1874-modelo-1500_110_kw_150_cv_400_690v_162_m_h_12_mca_turbina_bronce"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td rowspan="6">VARIO MAGNUS</td>
                            <td>Vario 2,5</td>
                            <td>2,5</td>
                            <td>1,8</td>
                            <td>8,5</td>
                            <td>4,9</td>
                            <td colspan="9" rowspan="6">Velocidad variable variador [e]pool</td>
                            <td>110</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/445-1783-vario-magnus-trifasica-840025016504.html#/1862-potencia_cv_-25_cv/1875-modelo-18_kw_25_cv_400v_18_m_h_12_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Vario 3</td>
                            <td>3</td>
                            <td>2,2</td>
                            <td>9,4</td>
                            <td>5,3</td>
                            <td>125</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/445-1784-vario-magnus-trifasica-840025016504.html#/1687-potencia_cv_-30_cv/1876-modelo-22_kw_30_cv_400v_26_m_h_12_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Vario 4</td>
                            <td>4</td>
                            <td>3</td>
                            <td>12,5</td>
                            <td>6,9</td>
                            <td>140</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/445-1785-vario-magnus-trifasica-840025016504.html#/1689-potencia_cv_-40_cv/1877-modelo-30_kw_40_cv_400v_42_m_h_12_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Vario 5,5</td>
                            <td>5,5</td>
                            <td>4</td>
                            <td>15,3</td>
                            <td>8,8</td>
                            <td>160</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/445-1786-vario-magnus-trifasica-840025016504.html#/1691-potencia_cv_-55_cv/1878-modelo-40_kw_55_cv_400v_57_m_h_12_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Vario 7,5</td>
                            <td>7,5</td>
                            <td>5,5</td>
                            <td rowspan="2">-</td>
                            <td>12</td>
                            <td>180</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/445-1787-vario-magnus-trifasica-840025016504.html#/1867-potencia_cv_-75_cv/1879-modelo-55_kw_75_cv_400v_85_m_h_12_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Vario 10</td>
                            <td>10</td>
                            <td>7,5</td>
                            <td>15,8</td>
                            <td>180</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/445-1788-vario-magnus-trifasica-840025016504.html#/1869-potencia_cv_-100_cv/1880-modelo-75_kw_10_cv_400v_107_m_h_12_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>[e] MAGNUS</td>
                            <td>5,5</td>
                            <td>5,5</td>
                            <td>4</td>
                            <td>15,3</td>
                            <td>8,8</td>
                            <td colspan="9">Velocidad variable variador [e]pool <br>Motor de imanes permanentes</td>
                            <td>160</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/80-bomba-saci-e-magnus4-550-40-kw-55-cv-230400v-57-mh-12-mca-840025016510.html"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td class="vertical-text" rowspan="8">C. FILTRACIÓN</td>
                            <td rowspan="8">CF-2</td>
                            <td>300 </td>
                            <td>3</td>
                            <td>2,2</td>
                            <td>16,4</td>
                            <td>5,2</td>
                            <td>61</td>
                            <td>54</td>
                            <td>51</td>
                            <td>46</td>
                            <td>35</td>
                            <td>29</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td colspan="2">DN80 / DN80</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/447-1791-centrifuga-cf-2-840025017501.html#/1687-potencia_cv_-30_cv/1883-modelo-300_22_kw_30_cv_230_400v_46_m_h_12_mca_2900_rpm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>400 </td>
                            <td>4</td>
                            <td>3</td>
                            <td>12</td>
                            <td>6,9</td>
                            <td>70</td>
                            <td>64</td>
                            <td>59</td>
                            <td>55</td>
                            <td>49</td>
                            <td>42</td>
                            <td>30</td>
                            <td>-</td>
                            <td>-</td>
                            <td colspan="2">DN80 / DN80</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/447-1792-centrifuga-cf-2-840025017501.html#/1689-potencia_cv_-40_cv/1884-modelo-400_30_kw_40_cv_230_400v_55_m_h_12_mca_2900_rpm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>550 </td>
                            <td>5,5</td>
                            <td>4</td>
                            <td>16,5</td>
                            <td>9,5</td>
                            <td>95</td>
                            <td>90</td>
                            <td>84</td>
                            <td>77</td>
                            <td>65</td>
                            <td>54</td>
                            <td>32</td>
                            <td>-</td>
                            <td>-</td>
                            <td colspan="2" rowspan="6">DN125 / DN100</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/447-1793-centrifuga-cf-2-840025017501.html#/1691-potencia_cv_-55_cv/1885-modelo-550_40_kw_55_cv_230_400v_77_m_h_12_mca_2900_rpm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>551 </td>
                            <td>5,5</td>
                            <td>4</td>
                            <td>16,5</td>
                            <td>9,5</td>
                            <td>128</td>
                            <td>121</td>
                            <td>107</td>
                            <td>90</td>
                            <td>69</td>
                            <td>30</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/447-1794-centrifuga-cf-2-840025017501.html#/1691-potencia_cv_-55_cv/1886-modelo-551_40_kw_55_cv_230_400v_90_m_h_12_mca_2900_rpm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>750 </td>
                            <td>7,5</td>
                            <td>5,5</td>
                            <td>21,7</td>
                            <td>12,5</td>
                            <td>159</td>
                            <td>152</td>
                            <td>135</td>
                            <td>125</td>
                            <td>109</td>
                            <td>88</td>
                            <td>60</td>
                            <td>-</td>
                            <td>-</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/447-1795-centrifuga-cf-2-840025017501.html#/1867-potencia_cv_-75_cv/1887-modelo-750_55_kw_75_cv_400_690v_125_m_h_12_mca_2900_rpm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>1000 </td>
                            <td>10</td>
                            <td>7,5</td>
                            <td rowspan="3">-</td>
                            <td>15,5</td>
                            <td>175</td>
                            <td>166</td>
                            <td>158</td>
                            <td>147</td>
                            <td>135</td>
                            <td>119</td>
                            <td>98</td>
                            <td>68</td>
                            <td>-</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/447-1796-centrifuga-cf-2-840025017501.html#/1869-potencia_cv_-100_cv/1888-modelo-1000_75_kw_100_cv_400_690v_147_m_h_12_mca_2900_rpm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>1250 </td>
                            <td>12,5</td>
                            <td>9,2</td>
                            <td>19</td>
                            <td>195</td>
                            <td>188</td>
                            <td>175</td>
                            <td>163</td>
                            <td>150</td>
                            <td>136</td>
                            <td>105</td>
                            <td>86</td>
                            <td>-</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/447-1797-centrifuga-cf-2-840025017501.html#/1871-potencia_cv_-125_cv/1889-modelo-1250_92_kw_125_cv_400_690v_163_m_h_12_mca_2900_rpm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>1500 </td>
                            <td>15</td>
                            <td>11</td>
                            <td>23</td>
                            <td>200</td>
                            <td>197</td>
                            <td>193</td>
                            <td>183</td>
                            <td>170</td>
                            <td>155</td>
                            <td>132</td>
                            <td>110</td>
                            <td>87</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/447-1798-centrifuga-cf-2-840025017501.html#/1873-potencia_cv_-150_cv/1890-modelo-1500_110_kw_150_cv_400_690v_183_m_h_12_mca_2900_rpm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td class="vertical-text" rowspan="12">C. HIDROTERÁPIA</td>
                            <td rowspan="4">Bravus</td>
                            <td>300 M</td>
                            <td rowspan="2">3</td>
                            <td rowspan="2">2,2</td>
                            <td rowspan="2">9,4</td>
                            <td rowspan="2">5,3</td>
                            <td rowspan="2">59</td>
                            <td rowspan="2">54</td>
                            <td rowspan="2">47</td>
                            <td rowspan="2">39</td>
                            <td rowspan="2">28</td>
                            <td rowspan="2">16</td>
                            <td rowspan="2">-</td>
                            <td rowspan="2">-</td>
                            <td rowspan="2">-</td>
                            <td rowspan="4">3" (DN90)</td>
                            <td rowspan="4">90</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/235-1802-bravus-840025197763.html#/1687-potencia_cv_-30_cv/1693-corriente-monofasica/1894-modelo-22_kw_30_cv_230v_44_m_h_12_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>300 T</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/235-1799-bravus-840025197763.html#/1686-corriente-trifasica/1687-potencia_cv_-30_cv/1891-modelo-22_kw_30_cv_400v_44_m_h_12_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>400 T</td>
                            <td>4</td>
                            <td>3</td>
                            <td>12,5</td>
                            <td>6,9</td>
                            <td>68</td>
                            <td>63</td>
                            <td>58</td>
                            <td>52</td>
                            <td>45</td>
                            <td>36</td>
                            <td>23</td>
                            <td>-</td>
                            <td>-</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/235-1800-bravus-840025197763.html#/1686-corriente-trifasica/1689-potencia_cv_-40_cv/1892-modelo-30_kw_40_cv_400v_57_m_h_12_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>500 T</td>
                            <td>5,5</td>
                            <td>4</td>
                            <td>-</td>
                            <td>8,8</td>
                            <td>78</td>
                            <td>74</td>
                            <td>70</td>
                            <td>65</td>
                            <td>59</td>
                            <td>50</td>
                            <td>39</td>
                            <td>-</td>
                            <td>-</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/235-1801-bravus-840025197763.html#/1686-corriente-trifasica/1691-potencia_cv_-55_cv/1893-modelo-40_kw_55_cv_400v_67_m_h_12_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td rowspan="8">Kontra</td>
                            <td>4-250</td>
                            <td>2,5</td>
                            <td>1,8</td>
                            <td>8,5</td>
                            <td>4,9</td>
                            <td>53</td>
                            <td>43</td>
                            <td>32</td>
                            <td>18</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td rowspan="8">Ø ASP/IMP 110</td>
                            <td>110</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/236-1803-kontra-trifasica-840025016490.html#/1862-potencia_cv_-25_cv/1895-modelo-250_18_kw_25_cv_230_400v_13_m_h_12_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>4-300</td>
                            <td>3</td>
                            <td>2,2</td>
                            <td>9,4</td>
                            <td>5,3</td>
                            <td>62</td>
                            <td>54</td>
                            <td>43</td>
                            <td>26</td>
                            <td>10</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>125</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/236-1804-kontra-trifasica-840025016490.html#/1687-potencia_cv_-30_cv/1896-modelo-300_22_kw_30_cv_230_400v_26_m_h_12_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>4-400</td>
                            <td>4</td>
                            <td>3</td>
                            <td>12,5</td>
                            <td>6,9</td>
                            <td>74</td>
                            <td>66</td>
                            <td>56</td>
                            <td>42</td>
                            <td>29</td>
                            <td>14</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>140</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/236-1805-kontra-trifasica-840025016490.html#/1689-potencia_cv_-40_cv/1897-modelo-400_30_kw_40_cv_230_400v_42_m_h_12_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>4-550</td>
                            <td>5,5</td>
                            <td>4</td>
                            <td>15,3</td>
                            <td>8,8</td>
                            <td>123</td>
                            <td>104</td>
                            <td>84</td>
                            <td>57</td>
                            <td>30</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>160</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/236-1806-kontra-trifasica-840025016490.html#/1691-potencia_cv_-55_cv/1898-modelo-550_40_kw_55_cv_230_400v_57_m_h_12_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>4-750</td>
                            <td>7,5</td>
                            <td>5,5</td>
                            <td rowspan="4">-</td>
                            <td>12</td>
                            <td>143</td>
                            <td>127</td>
                            <td>107</td>
                            <td>85</td>
                            <td>57</td>
                            <td>12</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td rowspan="3">180</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/236-1807-kontra-trifasica-840025016490.html#/1867-potencia_cv_-75_cv/1899-modelo-750_55_kw_75_cv_400_690v_85_m_h_12_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>4-1000</td>
                            <td>10</td>
                            <td>7,5</td>
                            <td>15,8</td>
                            <td>160</td>
                            <td>145</td>
                            <td>126</td>
                            <td>107</td>
                            <td>80</td>
                            <td>48</td>
                            <td>14</td>
                            <td>-</td>
                            <td>-</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/236-1808-kontra-trifasica-840025016490.html#/1869-potencia_cv_-100_cv/1900-modelo-1000_75_kw_100_cv_400_690v_107_m_h_12_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>4-1250</td>
                            <td>12,5</td>
                            <td>9,2</td>
                            <td>18,5</td>
                            <td rowspan="2">-</td>
                            <td>167</td>
                            <td>152</td>
                            <td>136</td>
                            <td>118</td>
                            <td>99</td>
                            <td>80</td>
                            <td>47</td>
                            <td>-</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/236-1809-kontra-trifasica-840025016490.html#/1871-potencia_cv_-125_cv/1901-modelo-1250_92_kw_125_cv_400_690v_136_m_h_12_mca_turbina_bronce"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>4-1500</td>
                            <td>15</td>
                            <td>11</td>
                            <td>20,9</td>
                            <td>188</td>
                            <td>177</td>
                            <td>162</td>
                            <td>146</td>
                            <td>130</td>
                            <td>112</td>
                            <td>92</td>
                            <td>66</td>
                            <td>200</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/236-1810-kontra-trifasica-840025016490.html#/1873-potencia_cv_-150_cv/1902-modelo-1500_110_kw_150_cv_400_690v_162_m_h_12_mca_turbina_bronce"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="{{ route('guias.bombas.saci.index', ['user' => $userEncoded]) }}" class="btn-volver">Volver</a>
        </div>
    </div>
</main>
@endsection
