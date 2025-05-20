
import Navbar from "@/components/Navbar";
import Footer from "@/components/Footer";
import WhatsAppButton from "@/components/WhatsAppButton";
import { useParams } from "react-router-dom";
import { Building, FileText, Shield, Wrench, Users, Phone } from "lucide-react";
import { Button } from "@/components/ui/button";
import { Link } from "react-router-dom";

const servicosDetalhes = {
  "administracao": {
    icon: <Building className="h-16 w-16 text-brand-teal" />,
    title: "Administração de Condomínios",
    description: "Oferecemos uma gestão completa e personalizada para condomínios de todos os portes, garantindo transparência, eficiência e tranquilidade para síndicos e moradores.",
    benefits: [
      "Gestão financeira completa com prestação de contas mensal",
      "Organização e condução de assembleias",
      "Gerenciamento de funcionários e terceirizados",
      "Planejamento orçamentário anual",
      "Cobrança de inadimplentes",
      "Atendimento personalizado a síndicos e condôminos",
      "Suporte jurídico especializado"
    ],
    process: [
      "Análise inicial da situação do condomínio",
      "Proposta personalizada de gestão",
      "Transição suave da administração anterior",
      "Implementação de processos e ferramentas",
      "Acompanhamento contínuo e relatórios periódicos"
    ]
  },
  "consultoria": {
    icon: <FileText className="h-16 w-16 text-brand-teal" />,
    title: "Consultoria Condominial",
    description: "Nossa consultoria especializada oferece soluções para desafios específicos em condomínios, sem necessidade de mudança na administração atual.",
    benefits: [
      "Análise financeira detalhada",
      "Revisão e adequação de convenção e regimento interno",
      "Orientação em questões jurídicas e tributárias",
      "Mediação de conflitos condominiais",
      "Avaliação de contratos e fornecedores",
      "Implementação de melhorias na gestão",
      "Suporte para decisões estratégicas"
    ],
    process: [
      "Diagnóstico da situação atual",
      "Identificação dos pontos críticos",
      "Desenvolvimento de plano de ação",
      "Implementação das soluções recomendadas",
      "Acompanhamento e avaliação dos resultados"
    ]
  },
  "assembleias": {
    icon: <Users className="h-16 w-16 text-brand-teal" />,
    title: "Assembleias e Reuniões",
    description: "Organizamos e conduzimos assembleias e reuniões condominiais de forma profissional, garantindo que todas as decisões sejam tomadas dentro da legalidade e com máxima participação dos condôminos.",
    benefits: [
      "Preparação completa da documentação",
      "Envio de convocações dentro dos prazos legais",
      "Condução profissional das reuniões",
      "Registro adequado de atas e deliberações",
      "Maximização da participação dos condôminos",
      "Atendimento às exigências legais",
      "Resolução eficiente de conflitos"
    ],
    process: [
      "Planejamento da assembleia conforme necessidades do condomínio",
      "Elaboração e envio de convocações",
      "Preparação de materiais e documentos",
      "Condução da assembleia",
      "Elaboração de ata e registro das deliberações"
    ]
  },
  "manutencao": {
    icon: <Wrench className="h-16 w-16 text-brand-teal" />,
    title: "Manutenção Preventiva",
    description: "Desenvolvemos e implementamos planos de manutenção preventiva para preservar o patrimônio do condomínio, evitar problemas estruturais e reduzir custos a longo prazo.",
    benefits: [
      "Preservação do valor patrimonial do condomínio",
      "Redução de custos com reparos emergenciais",
      "Aumento da vida útil das instalações",
      "Maior segurança para os moradores",
      "Planejamento financeiro para manutenções",
      "Cumprimento das normas técnicas e de segurança",
      "Acompanhamento profissional de prestadores de serviço"
    ],
    process: [
      "Vistoria técnica completa das instalações",
      "Elaboração de plano de manutenção periódica",
      "Cronograma de intervenções preventivas",
      "Seleção de fornecedores qualificados",
      "Acompanhamento e supervisão dos serviços",
      "Relatórios técnicos e documentação"
    ]
  },
  "seguranca": {
    icon: <Shield className="h-16 w-16 text-brand-teal" />,
    title: "Segurança Condominial",
    description: "Oferecemos soluções integradas para garantir a segurança dos moradores e do patrimônio, combinando tecnologia, processos e treinamento de pessoal.",
    benefits: [
      "Avaliação completa de riscos e vulnerabilidades",
      "Implementação de sistemas de controle de acesso",
      "Soluções de monitoramento por câmeras",
      "Protocolos de segurança personalizados",
      "Treinamento de porteiros e vigilantes",
      "Integração de sistemas de segurança",
      "Planos de contingência para emergências"
    ],
    process: [
      "Diagnóstico de segurança do condomínio",
      "Proposta de soluções adequadas ao perfil do condomínio",
      "Implementação de equipamentos e sistemas",
      "Treinamento da equipe de segurança",
      "Monitoramento contínuo e ajustes"
    ]
  },
  "atendimento": {
    icon: <Phone className="h-16 w-16 text-brand-teal" />,
    title: "Atendimento 24h",
    description: "Disponibilizamos suporte e atendimento 24 horas por dia, 7 dias por semana, para resolver emergências e necessidades dos condomínios a qualquer momento.",
    benefits: [
      "Plantão telefônico 24 horas",
      "Resposta rápida a emergências",
      "Acionamento imediato de prestadores de serviço",
      "Registro e acompanhamento de ocorrências",
      "Orientação em situações críticas",
      "Tranquilidade para síndicos e moradores",
      "Solução rápida de problemas urgentes"
    ],
    process: [
      "Cadastramento do condomínio no sistema de atendimento",
      "Definição de protocolos de emergência",
      "Disponibilização de canais de contato",
      "Atendimento imediato 24/7",
      "Acompanhamento até a resolução do problema"
    ]
  }
};

const ServicosPage = () => {
  const { tipo = "administracao" } = useParams();
  const servico = servicosDetalhes[tipo as keyof typeof servicosDetalhes] || servicosDetalhes.administracao;

  return (
    <div className="min-h-screen flex flex-col">
      <Navbar />
      
      <main className="flex-grow">
        {/* Hero da página */}
        <div className="bg-brand-blue text-white py-16">
          <div className="container mx-auto px-4">
            <div className="flex flex-col items-center text-center">
              <div className="mb-6">
                {servico.icon}
              </div>
              <h1 className="text-3xl md:text-4xl font-bold mb-4">{servico.title}</h1>
              <div className="w-20 h-1 bg-brand-teal mx-auto mb-6"></div>
              <p className="text-xl max-w-3xl">
                {servico.description}
              </p>
            </div>
          </div>
        </div>
        
        {/* Conteúdo */}
        <div className="container mx-auto px-4 py-16">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-16">
            {/* Benefícios */}
            <div>
              <h2 className="text-2xl font-bold text-brand-blue mb-6">Benefícios</h2>
              <ul className="space-y-4">
                {servico.benefits.map((beneficio, index) => (
                  <li key={index} className="flex items-start">
                    <div className="text-brand-teal mr-3 mt-1">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                      </svg>
                    </div>
                    <span>{beneficio}</span>
                  </li>
                ))}
              </ul>
            </div>
            
            {/* Processo */}
            <div>
              <h2 className="text-2xl font-bold text-brand-blue mb-6">Nosso Processo</h2>
              <ol className="space-y-6">
                {servico.process.map((passo, index) => (
                  <li key={index} className="flex">
                    <div className="mr-4">
                      <div className="flex items-center justify-center w-8 h-8 rounded-full bg-brand-teal text-white font-bold">
                        {index + 1}
                      </div>
                    </div>
                    <div>
                      <p className="text-lg">{passo}</p>
                    </div>
                  </li>
                ))}
              </ol>
            </div>
          </div>
          
          {/* CTA */}
          <div className="mt-16 text-center">
            <h2 className="text-2xl font-bold text-brand-blue mb-4">Quer saber mais sobre este serviço?</h2>
            <p className="text-gray-600 mb-8 max-w-2xl mx-auto">
              Entre em contato conosco hoje mesmo para uma consulta personalizada sobre como podemos ajudar seu condomínio.
            </p>
            <div className="flex flex-wrap justify-center gap-4">
              <Link to="/contato">
                <Button size="lg" className="bg-brand-teal hover:bg-blue-600 text-white font-medium px-8">
                  Solicitar Orçamento
                </Button>
              </Link>
              <Link to="/portal/cadastro">
                <Button size="lg" variant="outline" className="border-brand-blue text-brand-blue hover:bg-brand-blue hover:text-white">
                  Cadastrar Condomínio
                </Button>
              </Link>
            </div>
          </div>
        </div>
      </main>
      
      <Footer />
      <WhatsAppButton />
    </div>
  );
};

export default ServicosPage;
