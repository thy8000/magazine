import { useQuery, gql } from "@apollo/client";

import { Meta } from '../components/_index';

export default function FrontPage() {
  const { data } = useQuery(FrontPage.query);

  const siteGeneralSettings = data?.generalSettings ?? [];

  return (
    <>
      <Meta 
        title={siteGeneralSettings.title ?? ''}
        description={siteGeneralSettings.description ?? ''}
      />
      
      <h1>Front Page</h1>
    </>
  );
}

FrontPage.query = gql`
  query getFrontPage {
    generalSettings {
      title
      description
    }
  }
`;
